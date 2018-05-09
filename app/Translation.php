<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Aws\Translate;

class Translation extends Model
{
    public function sourcelanguage()
    {
        return $this->belongsTo('App\Sourcelanguage');
    }

    public function targetlanguage()
    {
        return $this->belongsTo('App\Targetlanguage');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    # Consolidate Translate API call code to limit repetition
    public function getTranslation($sourceLanguage, $targetLanguage, $input)
    {
        # Create new AWS client
        $client = new Translate\TranslateClient([
            'version' => 'latest',
            'region' => env('AWS_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY')
            ]
        ]);

        try {
            # Make call to AWS Translate
            $result = $client->translateText([
                'SourceLanguageCode' => $sourceLanguage,
                'TargetLanguageCode' => $targetLanguage,
                'Text' => $input
            ]);
            return $result;
        } catch (AwsException $e) {
            # Log error codes
            $result = [
                'errorCode' => $e->getAwsErrorCode(),
                'errorMessage' => $e->getAwsErrorMessage()
            ];
            return $result;
        }
    }
}
