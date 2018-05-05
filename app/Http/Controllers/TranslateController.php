<?php

namespace App\Http\Controllers;

use Aws\Exception\AwsException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use App;
use Debugbar;
use App\Sourcelanguage;
use App\Targetlanguage;
use App\Translation;
use Aws\Translate;

class TranslateController extends Controller
{
    public function index()
    {
        # Fetch languages to populate the selectors
        $srcLang = Sourcelanguage::all();
        $targetLang = Targetlanguage::all();

        return view('translate.index')->with([
            'srcLang' => $srcLang,
            'targetLang' => $targetLang
        ]);
    }

    public function translate(Request $request)
    {
        # Validate text area input
        $customMessage = [
            'translateText.regex' => 'Only letters, numbers, and punctuation (e.g. periods and spaces) are allowed in input text.',
            'translateText.max' => 'Please enter 150 characters or fewer.'
        ];
        $validatedText = $request->validate([
            'translateText' => array('required', 'max:150', 'regex:/^[A-Za-z0-9_.,!?()"\'\s]+$/')
        ], $customMessage);

        # Create new AWS client
        $client = new Translate\TranslateClient([
            'version' => 'latest',
            'region' => env('AWS_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY')
            ]
        ]);

        # Attempt to fetch translation from form request input
        try {
            # Make call to AWS Translate
            $result = $client->translateText([
                'SourceLanguageCode' => $request->input('sourceLanguage', 'en'),
                'TargetLanguageCode' => $request->input('targetLanguage', 'es'),
                'Text' => $validatedText['translateText']
            ]);

            # Get language objects to associate with the new translation DB entry
            $srcLangID = Sourcelanguage::where('short_name', '=', $result['SourceLanguageCode'])->first();
            $tarLangID = Targetlanguage::where('short_name', '=', $result['TargetLanguageCode'])->first();

            # Save result to database upon successful call
            $new_translation = new Translation();
            $new_translation->input = $validatedText['translateText'];
            $new_translation->output = $result['TranslatedText'];

            # Associate source and target language foreign keys
            $new_translation->sourceLanguage()->associate($srcLangID);
            $new_translation->targetLanguage()->associate($tarLangID);
            $new_translation->save();

            # Retrieve the newly saved entry to pass to view
            $result = Translation::orderBy('id', 'desc')->first();

            # Land on the newly saved translation detail page
            return redirect('/translations/' . $result['id']);

        } catch (AwsException $e) {
            $result = [
                'errorCode' => $e->getAwsErrorCode(),
                'errorMessage' => $e->getAwsErrorMessage()
            ];
        }

        return view('translate.output')->with([
            'result' => $result
        ]);

    }
}