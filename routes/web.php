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
});

/*
ボットからの送信を受け取る
コマンドハンドラで処理
*/
Route::post('/'.config('telegram.bots.mybot.token').'/webhook', function () {
    $update = Telegram::commandsHandler(true);

    if ($update->isType('callback_query')) {

        $message = $update->getMessage();    
        $chatId = $message->getChat()->getId();
        Telegram::sendMessage([
            'chat_id'  =>  $chatId, 
            'text'  =>  $update->isType('callback_query')
        ]);

        $query = $update->getCallbackQuery();
        $data  = $query->getData();
        $start = strpos($data, ' ');
    
        $command = ($start !== false) ? substr($data, 1, $start - 1) : substr($data, 1);
    
        if (in_array($command, $commands)) {
            $update->put('message', collect([
                'text' => substr($data, $start + 1),
                'from' => $query->getMessage()->getFrom(),
                'chat' => $query->getMessage()->getChat()
            ]));
           Telegram::triggerCommand($command, $update);
        }
    }

    $message = $update->getMessage();    
    $chatId = $message->getChat()->getId();


    if(preg_match('%NAVIを起動する%', $message->getText())){
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

    if(preg_match('%誰から？%', $message->getText())){
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


    if(preg_match('%開いて%', $message->getText())){
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

    if(preg_match('%(こんにちは|死んだはずじゃ・・・)%', $message->getText())){

        if(preg_match('%こんにちは%', $message->getText())){
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  '玲音は驚かないんだね'
            ]);

        } elseif(preg_match('%死んだはずじゃ・・・%', $message->getText())) {
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

    if(preg_match('%(覚えてる|覚えてない)%', $message->getText())){

        if(preg_match('%覚えてる%', $message->getText())){
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  '良かった'
            ]);

        } elseif(preg_match('%覚えてない%', $message->getText())) {
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

    if(preg_match('%(なんで私にメッセージを|どうして死んだの)%', $message->getText())){

        if(preg_match('%なんで私にメッセージを%', $message->getText())){
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  '玲音は、私と似てるような気がしたから。わかってくれるような気がして'
            ]);

        } elseif(preg_match('%どうして死んだの%', $message->getText())) {
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

    if(preg_match('%(わかる気がする|わかんないよ)%', $message->getText())){

        if(preg_match('%わかる気がする%', $message->getText())){
            Telegram::sendMessage([
                'chat_id'  =>  $chatId, 
                'text'  =>  '玲音ならそう言ってくれると思った'
            ]);

        } elseif(preg_match('%わかんないよ%', $message->getText())) {
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

    
    if(preg_match('%(うん|いやだ)%', $message->getText())){

        if(preg_match('%うん%', $message->getText())){
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

        } elseif(preg_match('%いやだ%', $message->getText())) {
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

    return 'ok';
});
