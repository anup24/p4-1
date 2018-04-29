<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            # Pivot ids
            $table->integer('translation_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            # Foreign keys
            $table->foreign('translation_id')->references('id')->on('translations');
            $table->foreign('tag_id')->references('id')->on('tags');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_translation');
    }
}
