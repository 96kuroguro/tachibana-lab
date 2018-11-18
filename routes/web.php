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
*/
Route::get('/set', function () {
    $res = Telegram::setWebhook([
        'url' => 'https://tachibana-lab.bacronym.net/'.config('telegram.bots.mybot.token').'/webhook'
    ]);
    dd($res);
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
                    $btn[$button->line][] = \Telegram\Bot\Keyboard\Keyboard::inlineButton(['text' => $button->text, 'callback_data' => $button->callback_data]);
                }

                /*
                作りたいデータ形式

                $kbs = [
                    1 => [
                        Keyboard::inlineButton(),
                        Keyboard::inlineButton(),
                        Keyboard::inlineButton(),
                    ],
                    2 => [
                        Keyboard::inlineButton(),
                        Keyboard::inlineButton(),
                    ],
                ];
                foreach($kbs as $kb){
                    //kb->coutn で switch 1 or 2 or 3
                    $keyboard->row($kb[0]);
                    $keyboard->row($kb[0], $kb[1]);
                    $keyboard->row($kb[0], $kb[1], $kb[2]);
                }
                */
                
                Telegram::sendMessage([
                    'chat_id'  =>  $chatId, 
                    'text'  =>  var_export($btn, true)
                ]);

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

            // $test = [
            //     \Telegram\Bot\Keyboard\Keyboard::inlineButton(['text' => 'NAVIを起動する', 'callback_data' => "navistart"]),
            //     \Telegram\Bot\Keyboard\Keyboard::inlineButton(['text' => 'NAVIを起動する', 'callback_data' => "navistart"])
            // ];

            // $keyboard = \Telegram\Bot\Keyboard\Keyboard::make()
            //     ->inline();
            //     foreach($test as $t){
            //         $keyboard->row(
            //             $t
            //         );
            //     }

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

    // //デバッグ出力
    // // $rs = var_export($update, true);
    // $message = $update->getMessage();    
    // $chatId = $update->getChat()->getId();

    // //コールバックデータからコマンドを呼び出し
    // $query = $update->getCallbackQuery();
    // if(!empty($query)){
    //     $data  = $query->getData();
    //     Telegram::getCommandBus()->execute($data, [], $update);
    // }

    // $rs = var_export(
    //     $query->getData(), 
    //     true
    // );
    // Telegram::sendMessage([
    //     'chat_id'  =>  $chatId, 
    //     'text'  =>  $rs
    // ]);




    /*
    if(preg_match('%NAVIを起動する%', $message)){
        $keyboard = \Telegram\Bot\Keyboard\Keyboard::make()
        ->row(
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => '誰から？'])
        );

        Telegram::sendPhoto([
            'chat_id'  =>  $chatId, 
            'photo'  =>  \Telegram\Bot\FileUpload\InputFile::create(asset('img/chisayomoda_bot/navi_boot1.jpg')),
            'caption' => "頑張ってます",           
        ]);
        Telegram::sendPhoto([
            'chat_id'  =>  $chatId, 
            'photo'  =>  \Telegram\Bot\FileUpload\InputFile::create(asset('img/chisayomoda_bot/navi_boot2.jpg')),
            'caption' => "あと・・・少し、まって",           
        ]);
        Telegram::sendPhoto([
            'chat_id'  =>  $chatId, 
            'photo'  =>  \Telegram\Bot\FileUpload\InputFile::create(asset('img/chisayomoda_bot/navi_on.jpg')),
            'caption' => "起動しました",           
        ]);

        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  "誰？"
        ]);

        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  "名前を入れて",
            'reply_markup' => $keyboard
        ]);
    }

    if(preg_match('%誰から？%', $message)){
        $keyboard = \Telegram\Bot\Keyboard\Keyboard::make()
        ->row(
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => '……開いて'])
        );

        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  '[よもだちさ]',
            'reply_markup' => $keyboard
        ]);
    }


    if(preg_match('%開いて%', $message)){
        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  '[メッセージを開きます]'
        ]);

        $keyboard = \Telegram\Bot\Keyboard\Keyboard::make()
        ->row(
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => 'こんにちは']),
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => '死んだはずじゃ・・・'])
        );

        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  'こんにちは、玲音',
            'reply_markup' => $keyboard
        ]);
    }

    if(preg_match('%(こんにちは|死んだはずじゃ・・・)%', $message)){

        if(preg_match('%こんにちは%', $message)){
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  '玲音は驚かないんだね'
            ]);

        } elseif(preg_match('%死んだはずじゃ・・・%', $message)) {
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  '死ぬという定義にもよるけど、私はただ肉体を捨てただけ'
            ]);

        }

        $keyboard = \Telegram\Bot\Keyboard\Keyboard::make()
        ->row(
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => '覚えてる']),
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => '覚えてない'])
        );

        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  '玲音とは一度だけ一緒に帰ったことあったよね、覚えてる？',
            'reply_markup' => $keyboard
        ]);

    }

    if(preg_match('%(覚えてる|覚えてない)%', $message)){

        if(preg_match('%覚えてる%', $message)){
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  '良かった'
            ]);

        } elseif(preg_match('%覚えてない%', $message)) {
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  'そっか、たまたま一緒になっただけだし仕方ないよね'
            ]);

        }

        $keyboard = \Telegram\Bot\Keyboard\Keyboard::make()
        ->row(
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => 'なんで私にメッセージを']),
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => 'どうして死んだの'])
        );

        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  '……学校のみんなにはびっくりさせちゃったね',
            'reply_markup' => $keyboard
        ]);

    }

    if(preg_match('%(なんで私にメッセージを|どうして死んだの)%', $message)){

        if(preg_match('%なんで私にメッセージを%', $message)){
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  '玲音は、私と似てるような気がしたから。わかってくれるような気がして'
            ]);

        } elseif(preg_match('%どうして死んだの%', $message)) {
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  '肉体に意味なんてないって気づいたの'
            ]);

        }

        $keyboard = \Telegram\Bot\Keyboard\Keyboard::make()
        ->row(
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => 'わかる気がする']),
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => 'わかんないよ'])
        );

        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  '結局、人の思考なんてただのプログラムに過ぎない、そう思わない？',
            'reply_markup' => $keyboard
        ]);

    }

    if(preg_match('%(わかる気がする|わかんないよ)%', $message)){

        if(preg_match('%わかる気がする%', $message)){
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  '玲音ならそう言ってくれると思った'
            ]);

        } elseif(preg_match('%わかんないよ%', $message)) {
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  'そっちにいるとわかりにくいのかもね'
            ]);

        }

        $keyboard = \Telegram\Bot\Keyboard\Keyboard::make()
        ->row(
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => 'うん']),
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => 'いやだ'])
        );

        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  '玲音もワイヤードへおいでよ',
            'reply_markup' => $keyboard
        ]);

    }

    
    if(preg_match('%(うん|いやだ)%', $message)){

        if(preg_match('%うん%', $message)){
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  "ここから飛べば"
            ]);
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  "千砂ちゃんとずっと一緒に遊べるね"
            ]);
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  "ふふふ"
            ]);

        } elseif(preg_match('%いやだ%', $message)) {
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  "そもそも"
            ]);
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  "境界なんてきっちりしてないの"
            ]);
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  "私がそっちへ行かなくても"
            ]);
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  "あんたが勝手に来ればいいだけ"
            ]);
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  "ふんっ"
            ]);
        }

        $keyboard = \Telegram\Bot\Keyboard\Keyboard::make()
        ->row(
            \Telegram\Bot\Keyboard\Keyboard::button(['text' => '私は……'])
        );

        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  "あなたは誰？",
            'reply_markup' => $keyboard
        ]);

    }
    */

/*
    C：こんにちは	C：死んだはずじゃ？
    ＋1	－1
    驚かないんだね	私はただ肉体を捨てただけ
    玲音とは一度だけ一緒に帰ったことあったよね、覚えてる？	
    C：うん	C：覚えてない
    ＋1	－1
        そっか、たまたま一緒になっただけだし仕方ないよね
        
    C：なんで私にメッセージを	C：どうして死んだの
    ＋1	－1
    私と似てるような気がしたから	肉体に意味なんてない
    結局、人の思考なんてただのプログラムに過ぎない、そう思わない？	
    C：わかる気がする	C：わかんないよ
    ＋1	－1
    玲音ならそう言ってくれると思った	そっちにいるとわかりにくいのかもね
    玲音もワイヤードへおいでよ	


    C：うん		C：いやだ	
＋のとき	ーのとき	＋のとき	ーのとき
ペルソナ	PS玲音	レイン	玲音

これがワイヤードに残された記録
断片しか残ってないけど
この記録も
あなたも
こっちでずっと一緒だね


膝が震えるけど
ここから飛べば
また千砂ちゃんと遊べるね
ふふふ


そもそも
境界なんてきっちりしてないの
私がそっちへ行かなくても
あんたが勝手に来ればいいだけ
ふんっ


私は肉体を捨てるのは怖いな
今度お父さんに新しいNAVIを買ってもらえるか聞いてみる
良いマシンなら
フルレンジフルモーションでメタファライズできるかな
その時はよろしくね
*/

    return response('', 200);
});
