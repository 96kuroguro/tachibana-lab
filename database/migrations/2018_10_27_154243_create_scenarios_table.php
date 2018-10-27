<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScenariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('scene')->comment('会話シーン番号');
            $table->integer('route')->comment('ルート分岐');
            $table->integer('order')->comment('順番');

            $table->string('send_type')->comment('送信タイプ');//text、photo、document
            $table->string('message')->comment('メッセージ');
            $table->string('file')->comment('ファイル');

            $table->integer('next_scene')->comment('次のシーン');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scenarios');
    }
}
