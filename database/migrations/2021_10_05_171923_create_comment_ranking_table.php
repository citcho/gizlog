<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCommentRankingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_ranking', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->unsignedInteger('comment_count')->index();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('comment_ranking');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
