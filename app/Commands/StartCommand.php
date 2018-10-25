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
        /*
        'id' => $bot->getId(),
        'is_bot' => $bot->getIsBot(),
        'first_name' => $bot->getFirstName(),
        'language_code' => $bot->getLanguageCode(),
        'username' => $bot->getUsername(), //未設定の場合は存在しない
        */
        // $bot = $this->getTelegram()->getMe();//botの情報

        $update = $this->getUpdate();
        $user = $update->getMessage()->getFrom();

        //DBと称号
        $me = CybotUser::where('from_id', $user->getId())->first();

        //データが有る場合は削除
        if($me){
            $me->delete();
        }

        //データを初期化
        $me = CybotUser::create([
            'from_id'=>$user->getId(),
            'is_bot'=>$user->getIsBot(),
            'first_name'=>$user->getFirstName(),
            'language_code'=>$user->getLanguageCode(),
            'name'=>null,
            'scene'=>1, //初期値
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
