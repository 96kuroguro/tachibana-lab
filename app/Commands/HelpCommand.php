<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\FileUpload\InputFile;

class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'help';

    /**
     * @var string Command Description
     */
    protected $description = 'How to play';

    /*
     * {@inheritdoc}
     */
    public function handle($arguments)
    {

        $keyboard = Keyboard::make()
        ->inline()
        ->row(
            Keyboard::inlineButton(['text' => 'NAVIを起動する', 'callback_data' => "navistart"])
        );

        $this->replyWithMessage([
            'text' => "ワイヤードの千砂ちゃんと会話を楽しめるボットです。\nNAVIを起動するとメッセージが届きます。\n会話の先にどのような結末が待っているのかその目で確かめてください。", 
            'reply_markup' => $keyboard
            ]);

            return "ok";

    }

}
