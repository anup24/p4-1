<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectTranslationsAndSourcelanguages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('translations', function (Blueprint $table) {

            # Add signed int column to hold id
            $table->integer('sourcelanguage_id')->unsigned();

            # FK Reference
            $table->foreign('sourcelanguage_id')->references('id')->on('sourcelanguages');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->dropForeign('translations_sourcelanguage_id_foreign');
            $table->dropColumn('sourcelanguage_id');
        });
    }
}
