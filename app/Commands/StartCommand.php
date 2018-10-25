<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use App\Models\CybotUser;
use Telegram;

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
        $bot = $this->getTelegram()->getMe();//botの情報
        $update = $this->getUpdate();
        $user = $update->getMessage()->getFrom();
        $this->replyWithMessage([
            'text' => var_export(
                [
                    'id' => $bot->getId(),
                    'is_bot' => $bot->isBot(),
                    'first_name' => $bot->getFirstName(),
                    'language_code' => $bot->getLanguageCode(),
                ]
                , true), 
        ]);
        //データが有る場合は削除して初期化

        //データがない場合は初期化
        CybotUser::create([
            'from_id'=>$user->getId(),
            'is_bot'=>false,
            'first_name'=>$user->getFirstName(),
            'language_code'=>$user->getLanguageCode(),
            'name'=>null,
            'turn'=>1, //初期値
            'san'=>1, //初期値
        ]);

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
