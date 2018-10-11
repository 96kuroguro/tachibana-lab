<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\FileUpload\InputFile;

class NaviStartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'navistart';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['navistartcommand'];

    /**
     * @var string Command Description
     */
    protected $description = '';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        // $commands = $this->telegram->getCommands();

        // $text = '';
        // foreach ($commands as $name => $handler) {
        //     $text .= sprintf('/%s - %s'.PHP_EOL, $name, $handler->getDescription());
        // }

        // $this->replyWithMessage(compact('text'));

        // $this->replyWithMessage(['text' => '']);

        // $keyboard = Keyboard::make()
        // ->inline()
        // ->row(
        //     Keyboard::inlineButton(['text' => 'NAVIを起動する', 'callback_data' => "/navistart"]),
        //     Keyboard::inlineButton(['text' => 'ヘルプ', 'callback_data' => "/help"])
        // );

        // $button = [
        //     ['誰から？', '（遊び方[?]）'],
        // ];
        
        // $keyboard = $telegram->replyKeyboardMarkup([
        //     'keyboard' => $button, 
        //     'resize_keyboard' => true, 
        //     'one_time_keyboard' => true
        // ]);

        // $keyboard = Keyboard::make()
        // ->row(
        //     Keyboard::button(['text' => 'NAVIを起動する'])
        // );

        // $this->replyWithMessage(['text' => "あなたはNAVIを起動してあるメッセージを受け取ります。\n会話を進めた結果、あなたは最後にどのような存在になるでしょう？", 'reply_markup' => $keyboard]);
        $this->replyWithPhoto([
            'photo' => InputFile::create(asset('img/chisayomoda_bot/navi_boot1.jpg')), 
            'caption' => '頑張ってます・・',
        ]);
        $this->replyWithPhoto([
            'photo' => InputFile::create(asset('img/chisayomoda_bot/navi_boot2.jpg')), 
            'caption' => 'あと、少し・・待って',
        ]);
        $this->replyWithMessage(['text' => "logon：\nだれ？\nEnter ID"]);
        //lain
        //（復唱）lain、名前を喋って！　Voice PassWord
        //れ　い　ん
        //Accept
        //lainだね！\nAccept!
        //lain宛にメッセージが届いています
        //誰から？
        //四方田千砂
        //メッセージを表示しますか？
        //こんにちは、元気？

        // $this->replyWithPhoto([
        //     'photo' => InputFile::create(asset('img/chisayomoda_bot/navi_on.jpg')), 
        //     'caption' => '頑張ってます・・',
        // ]);

        // $this->replyWithMessage(['text' => asset('img/chisayomoda_bot/navi_off.jpg'), 'reply_markup' => $keyboard]);


    }

}
