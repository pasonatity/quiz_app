<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstPublicTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_public_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('public_type_name')->comment('公開状態名');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE mst_public_types COMMENT '公開状態マスタ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_public_types');
    }
}
