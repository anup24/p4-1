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
        # Fetch entry from DB
        $entry = Translation::find($id);

        # Check if anything returned
        if (is_null($entry)) {
            # Return to directory with alert message
            return redirect('/translations')->with([
                'alert' => 'The specified entry was not found.'
            ]);
        }

        return view('translations.show')->with([
            'entry' => $entry,
            'enableButtons' => false
        ]);
    }

    public function edit($id)
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

        return view('translations.show')->with([
            'entry' => $entry,
            'enableButtons' => false
        ]);
    }

    public function update(Request $request, $id)
    {

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