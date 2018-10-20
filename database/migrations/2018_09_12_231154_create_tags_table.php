<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedInteger('quiz_id')->comment('クイズID');
            $table->unsignedInteger('mst_tag_id')->comment('タグID');
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes');
            $table->foreign('mst_tag_id')->references('id')->on('mst_tags');
            $table->unique(['quiz_id', 'mst_tag_id']);
        });

        DB::statement("ALTER TABLE tags COMMENT 'タグデータ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
