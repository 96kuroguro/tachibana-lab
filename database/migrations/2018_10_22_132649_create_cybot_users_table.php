<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCybotUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cybot_users', function (Blueprint $table) {
            $table->increments('id');
            /*
            from （ID、ボット正否、名前、言語）
                'id' => 326377703,
                'is_bot' => false,
                'first_name' => 'サスケ',
                'language_code' => 'ja-jp',
            name （最初にNAVIに入力する名前：今後呼ばれる名前）
            turn （会話の進行具合：進行度に合わないアクションは拒絶される）
            san （SAN値：ステータスの高さで最終的な結果が変わる）

            */
            $table->integer('from_id');
            $table->tinyInteger('is_bot');
            $table->string('first_name');
            $table->string('language_code');
            $table->string('name')->nullable();
            $table->integer('turn');
            $table->integer('san');
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
        Schema::dropIfExists('cybot_users');
    }
}
