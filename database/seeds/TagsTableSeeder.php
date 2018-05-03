<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['Verified Accurate','images/verified.png'],
            ['Flagged as Inaccurate','images/inaccurate.png'],
            ['Flagged as Inappropriate','images/danger.png']
        ];

        foreach($tags as $tagName){
            $tag = new Tag();
            $tag->name = $tagName[0];
            $tag->image = $tagName[1];
            $tag->save();
        }
    }
}
