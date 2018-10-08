<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

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
    protected $description = '新規スタート';

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
        //     Keyboard::inlineButton(['text' => '誰から？', 'callback_data' => 'who']),
        //     Keyboard::inlineButton(['text' => '（遊び方）', 'callback_data' => 'help'])
        // );

        // $button = [
        //     ['誰から？', '（遊び方[?]）'],
        // ];
        
        // $keyboard = $telegram->replyKeyboardMarkup([
        //     'keyboard' => $button, 
        //     'resize_keyboard' => true, 
        //     'one_time_keyboard' => true
        // ]);

        $keyboard = Keyboard::make()
        ->row(
            Keyboard::button(['text' => 'NAVIを起動する'])
        );

        // $this->replyWithMessage(['text' => "あなたはNAVIを起動してあるメッセージを受け取ります。\n会話を進めた結果、あなたは最後にどのような存在になるでしょう？", 'reply_markup' => $keyboard]);
        $this->replyWithPhoto(['photo'=>asset('img/chisayomoda_bot/navi_off.jpg'), 'reply_markup' => $keyboard]);

    }

}
