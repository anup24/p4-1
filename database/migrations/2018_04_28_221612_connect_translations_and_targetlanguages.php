<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectTranslationsAndTargetlanguages extends Migration
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
            $table->integer('targetlanguage_id')->unsigned();

            # FK Reference
            $table->foreign('targetlanguage_id')->references('id')->on('targetlanguages');

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
            $table->dropForeign('translations_targetlanguage_id_foreign');
            $table->dropColumn('targetlanguage_id');
        });
    }
}
