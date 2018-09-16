<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedInteger('user_id')->nullable()->comment('ユーザーID');
            $table->string('quiz_title')->comment('クイズタイトル');
            $table->string('quiz_sub_title')->comment('クイズサブタイトル');
            $table->unsignedInteger('participants_number')->comment('参加者数');
            $table->boolean('published')->comment('公開状態');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        DB::statement("ALTER TABLE quizzes COMMENT 'クイズデータ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
