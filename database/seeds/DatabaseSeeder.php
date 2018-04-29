<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BooksTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(SourcelanguagesTableSeeder::class);
        $this->call(TargetlanguagesTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
    }
}
