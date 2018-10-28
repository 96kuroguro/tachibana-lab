<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInlineButtonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inline_buttons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text')->comment('ボタン文字列');
            $table->string('callback_data')->comment('コールバックデータ');
            $table->timestamps();
        });

        Schema::create('inline_button_scenario', function (Blueprint $table) {
            $table->integer('scenario_id')->unsigned()->comment('シナリオID');
            $table->integer('inline_button_id')->unsigned()->comment('インラインボタンID');
            $table->integer('line')->unsigned()->comment('行');
            $table->integer('order')->unsigned()->comment('並び順');


            $table->foreign('scenario_id')
            ->references('id')
            ->on('scenarios')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('inline_button_id')
            ->references('id')
            ->on('inline_buttons')
            ->onDelete('cascade')
            ->onUpdate('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inline_buttons');
    }
}
