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
        # Fetch languages and pass to index
        $srcLang = Sourcelanguage::all();
        $targetLang = Targetlanguage::all();

        return view('translate.index')->with([
            'srcLang' => $srcLang,
            'targetLang' => $targetLang
        ]);
    }

    public function translate(Request $request)
    {
        # To Do:
        # - Pre-populate form with old()
        # - Use request fields in translate function

        # Validate text area input
        $validatedText = $request->validate([
            'translateText' => array('required', 'max:50')
        ]);

        # Create new AWS client
        $translate = new Translate\TranslateClient([
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
            $result = $translate->translateText([
                'SourceLanguageCode' => $request->input('sourceLanguage', 'en'),
                'TargetLanguageCode' => $request->input('targetLanguage', 'es'),
                'Text' => $validatedText['translateText']
            ]);

            # Get language objects
            $srcLangID = Sourcelanguage::where('short_name','=',$result['SourceLanguageCode'])->first();
            $tarLangID = Targetlanguage::where('short_name','=',$result['TargetLanguageCode'])->first();

            # Save result to database upon successful call
            $new_translation = new Translation();
            $new_translation->input = $validatedText['translateText'];
            $new_translation->output = $result['TranslatedText'];
            # Associate source and target language foreign keys
            $new_translation->sourceLanguage()->associate($srcLangID);
            $new_translation->targetLanguage()->associate($tarLangID);
            $new_translation->save();

            dump($new_translation->toArray());

        } catch (AwsException $e) {
            $result = [
                'errorCode' => $e->getAwsErrorCode(),
                'errorMessage' => $e->getAwsErrorMessage()
            ];
        }

        dump($result);

        # TO DO:
        # - Pass saved DB entry to the output page (maybe redirect to /translations/{n})?
        # - Use the practice example to show all translations or a single one at /translations/{n}
        # - Otherwise use the error results. Change output.blade to error.blade?
        # - Buttons for "See all" or "Edit"
        # - Edit adds additional flags
        # Use old() on the form inputs

        return view('translate.output')->with([
            'input' => $validatedText['translateText'],
            'result' => $result
        ]);

    }


    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://foobooks.loc/practice => Shows a listing of all practice routes
     * http://foobooks.loc/practice/1 => Invokes practice1
     * http://foobooks.loc/practice/5 => Invokes practice5
     * http://foobooks.loc/practice/999 => 404 not found
     *
     * public function index($n = null)
     * {
     * $methods = [];
     *
     * # If no specific practice is specified, show index of all available methods
     * if (is_null($n)) {
     * foreach (get_class_methods($this) as $method) {
     * if (strstr($method, 'practice')) {
     * $methods[] = $method;
     * }
     * }
     * return view('practice')->with(['methods' => $methods]);
     * } # Otherwise, load the requested method
     * else {
     * $method = 'practice' . $n;
     * return (method_exists($this, $method)) ? $this->$method() : abort(404);
     * }
     * }
     * */
}