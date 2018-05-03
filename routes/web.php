<?php


/* Get & Show */
Route::get('/', 'TranslateController@index');
Route::get('/translations','TranslationsController@index');
Route::get('/translations/{n?}','TranslationsController@show');

/* Create */
Route::post('/translate','TranslateController@translate');

/* Delete */
Route::get('/translations/{n?}/delete', 'TranslationsController@delete');
Route::delete('/translations/{n?}/delete', 'TranslationsController@destroy');


/****
 * Practice stuff below, not for final release
 */

/* Practice */
Route::any('/practice/{n?}', 'PracticeController@index');

/* DB Test Route */
Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});