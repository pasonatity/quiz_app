<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedInteger('quiz_id')->comment('クイズID');
            $table->string('quiz_content')->comment('クイズ内容');
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes');
        });

        DB::statement("ALTER TABLE questions COMMENT '質問データ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
