<?php

use Illuminate\Database\Seeder;
use App\Translation;

class TranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translations = [
            ['This is a test.', 'das ist ein Test.', 4],
            ['This is a test.', 'c\'est un test', 1]
        ];

        $count = count($translations);

        foreach ($translations as $key => $data) {

            $translation = new Translation();

            $translation->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $translation->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $translation->input = $data[0];
            $translation->output = $data[1];
            $translation->sourcelanguage_id = $data[2];

            $translation->save();
            $count--;
        }
    }
}
