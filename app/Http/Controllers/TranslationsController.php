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
        $translations = Translation::all();

        # Show all translations with edit/delete buttons
        return view('translations.index')->with([
            'translations' => $translations,
            'enableButtons' => true
        ]);
    }

    public function show($id)
    {
        # Fetch entry from DB
        $entry = Translation::where('id','=',$id)->first();
        if(is_null($entry)) {
            return abort(404);
        }

        return view('translations.show')-> with([
            'entry' => $entry,
            'enableButtons' => false
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