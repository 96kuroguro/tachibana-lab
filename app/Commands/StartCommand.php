<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\FileUpload\InputFile;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'start';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['startcommand'];

    /**
     * @var string Command Description
     */
    protected $description = 'New Game';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {

        //データが有る場合は削除して初期化

        //データがない場合は初期化

        $keyboard = Keyboard::make()
        ->inline()
        ->row(
            Keyboard::inlineButton(['text' => 'NAVIを起動する', 'callback_data' => "navistart"]),
            Keyboard::inlineButton(['text' => 'ヘルプ', 'callback_data' => "help"])
        );

        $this->replyWithPhoto([
            'photo' => asset('img/chisayomoda_bot/navi_off.jpg'), 
            'caption' => '停止中...',
            'reply_markup' => $keyboard
        ]);

        return response('', 200);

    }

}
