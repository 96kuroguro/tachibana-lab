<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/op', function () {
    return view('index');
});
Route::get('/', function () {
    return view('corp');
});

Route::get('/ss', function () { return view('ss.index'); });
Route::get('/ss/layer_01', function () { return view('ss.01'); });
Route::get('/ss/layer_02', function () { return view('ss.02'); });
Route::get('/ss/layer_03', function () { return view('ss.03'); });
Route::get('/ss/layer_04', function () { return view('ss.04'); });
Route::get('/ss/layer_05', function () { return view('ss.05'); });
Route::get('/ss/layer_06', function () { return view('ss.06'); });
Route::get('/ss/layer_07', function () { return view('ss.07'); });
Route::get('/ss/layer_08', function () { return view('ss.08'); });
Route::get('/ss/layer_09', function () { return view('ss.09'); });
Route::get('/ss/layer_10', function () { return view('ss.10'); });
Route::get('/ss/layer_11', function () { return view('ss.11'); });
Route::get('/ss/layer_12', function () { return view('ss.12'); });
Route::get('/ss/layer_13', function () { return view('ss.13'); });

Route::get('/twitter', 'TwitterController@index');
Route::get('/wired', 'MediaController@index');

Route::get('/afteroffparty', 'AfterOffPartyController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/test', function () {
    // $update = Telegram::commandsHandler(true);
    // $message = $update->getMessage();    
    // $chatId = $message->getChat()->getId();

    // $res = Telegram::sendDocument([
    //     'chat_id'  =>  $chatId, 
    //     'document'  =>  asset('img/chisayomoda_bot/navi_boot.gif')
    // ]);
    dd(asset('img/chisayomoda_bot/navi_boot.gif'));
});


/*
webhookのセット
URLを叩けばOK
セットが終わったら消しておく
*/
Route::get('/set', function () {
    // $res = Telegram::setWebhook([
    //     'url' => 'https://tachibana-lab.bacronym.net/'.config('telegram.bots.mybot.token').'/webhook'
    // ]);
    // dd($res);
});

/*
ボットからの送信を受け取る
コマンドハンドラで処理
*/
Route::post('/'.config('telegram.bots.mybot.token').'/webhook', function () {
    $update = Telegram::commandsHandler(true);


    $message = $update->getMessage();    
    $chatId = $update->getChat()->getId();

    $query = $update->getCallbackQuery();

    //コールバッククエリがある場合はスキップ（ない場合のみ処理）
    if(empty($query)){
        if($message->getEntities()){
            return response('', 200);
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  "bot_command"
            ]);
        }
    }

    //入力値がシーンとあっているか判定
    if(!empty($query)){ //コールバッククエリがある場合
        $data  = $query->getData();
        $type = "callback";
        //ボタンのコールバック文字列をvalueに入れる
        $value = $data;

        $user = \App\Models\CybotUser::where('from_id', $query->getFrom()->getId())->first();

    } else { //コールバッククエリがない場合
        $type = "text";

        //送信された文字列をvalueに入れる
        $value = $update->getMessage()->getText();

        $user = \App\Models\CybotUser::where('from_id', $message->getFrom()->getId())->first();
    }
    $result = \App\Models\CheckReceipt::where('scene', $user->scene)
    ->where('type', $type)
    ->where(function($q) use ($value){
        $q->orWhereNull('receipt')
              ->orWhere('receipt', 'LIKE', '%'.$value.'%');
    })
    ->where('turn', '<=', $user->turn)
    ->where('san', '<=', $user->san)
    ->orderBy('turn', 'desc')
    ->orderBy('san', 'desc')
    ->value('return');
    //result 返り値をチェックしてアクションを返す

    //result がある場合
    if($result){

        $scenes = \App\Models\Scenario::where('scene', $user->scene)
        ->where(function($q) use ($result){
            $q->orWhereNull('route')
                  ->orWhere('route', $result);
        })
        ->orderBy('order')
        ->get();

        foreach($scenes as $scene){

            if(
                ($scene->scene == 2 && $scene->route == 1) ||
                ($scene->scene == 3 && $scene->route == 3)
            ){
                $message = sprintf($scene->message, $value);

                $user->name = $value;
                $user->save();
            } else {
                $message = sprintf($scene->message, $user->name);
            }

            $keyboard = null;
            $inline_buttons = $scene->buttons()->orderBy('line')->orderBy('order')->get(); 
            if($inline_buttons->isNotEmpty()){
                //行で分けて配列に格納
                foreach($inline_buttons as $button){
                    $btn[$button->pivot->line][] = \Telegram\Bot\Keyboard\Keyboard::inlineButton(['text' => sprintf($button->text, $user->name), 'callback_data' => $button->callback_data]);
                }

                $keyboard = \Telegram\Bot\Keyboard\Keyboard::make()
                ->inline();
                foreach($btn as $b){
                    $count = count($b);
                    switch($count){
                        case 1:
                            $keyboard->row($b[0]);
                            break;                        
                        case 2:
                            $keyboard->row($b[0], $b[1]);
                            break;                        
                        case 3:
                            $keyboard->row($b[0], $b[1], $b[2]);
                            break;                        
                        case 4:
                            $keyboard->row($b[0], $b[1], $b[2], $b[3]);
                            break;                        
                        case 5:
                            $keyboard->row($b[0], $b[1], $b[2], $b[3], $b[4]);
                            break;                        
                    }
                }
            }

            switch($scene->send_type){
                case 'text':
                    Telegram::sendMessage([
                        'chat_id'  =>  $chatId, 
                        'text'  =>  $message,
                        'reply_markup' => $keyboard
                    ]);
                    break;

                case 'photo':
                    Telegram::sendPhoto([
                        'chat_id'  =>  $chatId, 
                        'photo'  =>  asset($scene->file),
                        'caption'  =>  $message,
                        'reply_markup' => $keyboard
                    ]);
                    break;

                case 'document':
                    Telegram::sendDocument([
                        'chat_id'  =>  $chatId, 
                        'document'  =>  asset($scene->file),
                        'caption'  =>  $message,
                        'reply_markup' => $keyboard
                    ]);
                    break;
            }

            $user->scene = $scene->next_scene;

        }

        $user->save();


    } else {//result がない場合
        //エラーメッセージテーブルから返す

        $error = \App\Models\ErrorMessage::where('scene', $user->scene)
        ->first();

        if(!$error){
            $error = \App\Models\ErrorMessage::whereNull('scene')
            ->inRandomOrder()->first();
        }

        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  $error->message
        ]);


    }

    //ターン数を1ずつ増やす
    $user->turn++;
    $user->save();

    Telegram::sendMessage([
        'chat_id'  =>  $chatId, 
        'text'  =>  "ターン：".$user->turn."／SAN値".$user->san
    ]);

    return response('', 200);
});
