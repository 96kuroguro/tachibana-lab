<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        id
        scene_id
        type
        update
        turn
        sun
        return
        */
        Schema::create('check_receipts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('scene')->comment('会話シーン番号');
            $table->string('type')->comment('タイプ');
            $table->string('receipt')->comment('送信文字列');
            $table->integer('turn')->default(0)->comment('会話進行度');
            $table->integer('san')->default(0)->comment('精神値');
            $table->integer('return')->comment('返り値');

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
        Schema::dropIfExists('check_receipts');
    }
}
