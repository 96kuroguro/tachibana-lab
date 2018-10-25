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
            scene （会話シーン番号：シーンと合わないアクションは拒絶される）
            turn （会話の進行具合：進行度に合わないアクションは拒絶される）
            san （SAN値：ステータスの高さで最終的な結果が変わる）

            */
            $table->integer('from_id')->unsigned()->unique()->comment('ユーザーID');
            $table->tinyInteger('is_bot')->comment('ボット判定');
            $table->string('first_name')->comment('名前');
            $table->string('language_code')->comment('言語');
            $table->string('name')->nullable()->comment('設定名');
            $table->integer('scene')->comment('会話シーン番号');
            $table->integer('turn')->comment('会話進行度');
            $table->integer('san')->comment('精神値');
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
