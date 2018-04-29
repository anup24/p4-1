<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use App;
use Debugbar;
use App\Sourcelanguage;
use App\Targetlanguage;
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
        # - Validate request
        # - Pre-populate form with old()
        # - Use request fields in translate function
        # - Add CSRF token


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
        $result = $translate->translateText([
            'SourceLanguageCode' => $request->input('sourceLanguage','en'),
            'TargetLanguageCode' => $request->input('targetLanguage','es'),
            'Text' => $request->input('translateText','Test post please ignore.')
        ]);

        dump($result);

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