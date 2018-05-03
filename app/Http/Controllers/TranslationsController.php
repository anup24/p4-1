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

        dump($entry);

        return view('translations.show')->with([
            'entry' => $entry,
            'enableButtons' => false
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
        # TO DO:
        # - Process edit form submission
        # - Validate input
        # - New AWS translation from request
        # - Redirect to edit page on AWS error with alert
        # - Save to DB and return to translations with alert if successful
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