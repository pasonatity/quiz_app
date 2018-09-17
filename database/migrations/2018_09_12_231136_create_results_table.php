<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedInteger('quiz_id')->comment('クイズID');
            $table->integer('correct_number')->comment('正解数');
            $table->string('comment')->comment('コメント');
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes');
        });

        DB::statement("ALTER TABLE results COMMENT '結果データ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}