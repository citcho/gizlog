<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnQuestionsTagCategoryId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign('questions_tag_category_id_foreign');
            $table->dropColumn('tag_category_id');
            Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->unsignedInteger('tag_category_id')->after('user_id')->nullable();
            $table->foreign('tag_category_id')->references('id')->on('tag_categories')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();
        });
    }
}
