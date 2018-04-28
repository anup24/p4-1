<?php

use Illuminate\Database\Seeder;
use App\Targetlanguage;

class TargetlanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $targetLanguages = [
            ['Arabic', 'ar'],
            ['Chinese (Simplified)', 'zh'],
            ['English', 'en'],
            ['French', 'fr'],
            ['German', 'de'],
            ['Portuguese', 'pt'],
            ['Spanish', 'es']
        ];

        $count = count($targetLanguages);

        foreach ($targetLanguages as $key => $data) {
            $language = new Targetlanguage;

            $language->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $language->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $language->name = $data[0];
            $language->short_name = $data[1];

            $language->save();
            $count--;
        }
    }
}
