<?php

use Illuminate\Database\Seeder;
use App\Sourcelanguage

class SourcelanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sourceLanguages = [
            ['Auto-Detect', 'auto'],
            ['Arabic', 'ar'],
            ['Chinese (Simplified)', 'zh'],
            ['English', 'en'],
            ['French', 'fr'],
            ['German', 'de'],
            ['Portuguese', 'pt'],
            ['Spanish', 'es']
        ];

        $count = count($sourceLanguages);

        foreach ($sourceLanguages as $key => $data) {
            $language = new Sourcelanguage;

            $language->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $language->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $language->name = $data[0];
            $language->short_name = $data[1];

            $language->save();
            $count--;
        }
    }
}
