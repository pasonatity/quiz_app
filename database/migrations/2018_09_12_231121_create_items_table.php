<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedInteger('question_id')->comment('質問ID');
            $table->boolean('correct')->comment('正誤');
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions');
        });

        DB::statement("ALTER TABLE items COMMENT '項目データ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
