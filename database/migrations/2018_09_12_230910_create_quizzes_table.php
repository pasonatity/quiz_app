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
            $table->string('quiz_sub_title')->nullable()->comment('クイズサブタイトル');
            $table->unsignedInteger('participants_number')->default(0)->comment('参加者数');
            $table->unsignedInteger('public_type')->comment('公開区分');
            $table->boolean('sort')->comment('問題順');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('set null');
            $table->foreign('public_type')->references('id')->on('mst_public_types');
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
