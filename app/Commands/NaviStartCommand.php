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
     * @var string Command Description
     */
    protected $description = '';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {

        // $this->replyWithPhoto([
        //     'photo' => asset('img/chisayomoda_bot/navi_boot1.jpg'), 
        //     'caption' => '頑張ってます・・',
        // ]);
        // $this->replyWithPhoto([
        //     'photo' => asset('img/chisayomoda_bot/navi_boot2.jpg'), 
        //     'caption' => 'あと、少し・・待って',
        // ]);

        $this->replyWithDocument([
            'document' => asset('img/chisayomoda_bot/navi_boot.gif'), 
        ]);

        $this->replyWithMessage(['text' => "> logon：\n> だれ？\n> Enter ID\n\n名前を入力してください"]);
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

        return response('', 200);

    }

}
