<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCategoryRankingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_ranking', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->primary();
            $table->unsignedInteger('question_count')->index();

            $table->foreign('category_id')->references('id')->on('tag_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('category_ranking');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
