<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Aggiungo la colonna category_id e do nullable, in quanto al momento non esiste nessuna categoria, e la migrate mi riempirebbe la colonna di zeri, rendendo poi impossibile la relazione

             $table->unsignedBigInteger('category_id')->nullable();

            // Aggiungo la relazione

             $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //Nel down si eseguono le operazioni a ritroso effettuate dall'up
            $table->dropForeign('posts_category_id_foreign');

            $table->dropColumn('category_id');
        });
    }
}
