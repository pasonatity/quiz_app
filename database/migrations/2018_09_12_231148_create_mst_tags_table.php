<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_tags', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('nag_name')->comment('タグ名');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE mst_tags COMMENT 'タグマスタ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_tags');
    }
}
