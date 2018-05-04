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
use App\Tag;
use Aws\Translate;

class TranslationsController extends Controller
{
    public function index()
    {
        # Fetch all translations from the DB
        $translations = Translation::orderBy('id', 'desc')->get();

        # Show all translations with edit/delete buttons
        return view('translations.index')->with([
            'translations' => $translations,
            'enableButtons' => true
        ]);
    }

    public function show($id)
    {
        # Fetch entry from DB and eager load tags
        $entry = Translation::with('tags')->find($id);

        # Check if anything returned
        if (is_null($entry)) {
            # Return to directory with alert message
            return redirect('/translations')->with([
                'alert' => 'The specified entry was not found.'
            ]);
        }

        return view('translations.show')->with([
            'entry' => $entry,
            'enableButtons' => true
        ]);
    }

    public function edit($id)
    {
        # Fetch entry from DB and eager load tags
        $entry = Translation::with('tags')->find($id);

        # Check if anything returned
        if (is_null($entry)) {
            # Return to directory with alert message
            return redirect('/translations')->with([
                'alert' => 'The specified entry was not found.'
            ]);
        }

        # Fetch languages and tags to populate the selectors
        $srcLang = Sourcelanguage::all();
        $targetLang = Targetlanguage::all();
        $tags = Tag::all();

        # Convert entry tags to array
        $tagArray = $entry->tags()->pluck('tags.id')->toArray();

        return view('translations.edit')->with([
            'entry' => $entry,
            'enableButtons' => false,
            'srcLang' => $srcLang,
            'targetLang' => $targetLang,
            'tags' => $tags,
            'tagArray' => $tagArray
        ]);
    }

    public function update(Request $request, $id)
    {
        # Validate text area input
        $customMessage = [
            'translateText.regex' => 'Only letters, numbers, and punctuation (e.g. periods and spaces) are allowed in input text.',
            'translateText.max' => 'Please enter 150 characters or fewer.'
        ];
        $validatedText = $request->validate([
            'translateText' => array('required', 'max:150', 'regex:/^[A-Za-z0-9_.,!;()"\'\s\-]+$/')
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
            $translation = Translation::find($id);
            $translation->input = $validatedText['translateText'];
            $translation->output = $result['TranslatedText'];

            # Associate source and target language foreign keys
            $translation->sourceLanguage()->associate($srcLangID);
            $translation->targetLanguage()->associate($tarLangID);

            # Sync tags
            $translation->tags()->sync($request->input('tags'));

            # Update the DB entry
            $translation->save();

            # Land on the newly saved translation detail page
            return redirect('/translations/' . $id . '/edit')->with([
                'alert' => 'Changes to translation #' . $id . ' saved successfully.'
            ]);

        } catch (AwsException $e) {
            $result = [
                'errorCode' => $e->getAwsErrorCode(),
                'errorMessage' => $e->getAwsErrorMessage()
            ];

            # Land back on edit page with error alert
            return redirect('/translations/' . $id . '/edit')->with([
                'alert' => 'Error: ' . $result['errorCode'] . '. Please correct and try again.'
            ]);
        }
    }

    public function delete($id)
    {
        # Fetch entry from DB
        $entry = Translation::find($id);

        # Check if anything returned
        if (is_null($entry)) {
            # Return to directory with alert message
            return redirect('/translations')->with([
                'alert' => 'The specified entry was not found.'
            ]);
        }

        return view('translations.delete')->with([
            'entry' => $entry,
            'enableButtons' => false
        ]);
    }

    public function destroy($id)
    {
        # Fetch entry from DB
        $entry = Translation::find($id);

        # Detach any associated tags
        $entry->tags()->detach();

        # Delete entry from DB
        $entry->delete();

        # Return to directory with alert message
        return redirect('/translations')->with([
            'alert' => 'Translation #' . $entry['id'] . ' was successfully deleted.'
        ]);
    }
}