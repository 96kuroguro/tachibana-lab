<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class MediaController extends Controller
{
    //
    public function index()
    {
        $connection = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret'), 
            config('twitter.access_token'),
            config('twitter.access_token_secret')
        );
        // $content = $connection->get("account/verify_credentials");
        // dd($content);

        $tweets = [];


        //serial experiments lain
        $statuses = $connection->get("search/tweets", ["count" => 15, "q" => "'serial experiments lain' OR 'serialexperimentslain' OR 'serial_experiments_lain' OR 'シリアルエクスペリメンツレイン' OR クラブサイベリア -rt filter:images"]);
        $datas['medias'] = $statuses->statuses;

        $statuses = $connection->get("search/tweets", ["count" => 15, "q" => "'serial experiments lain' OR 'serialexperimentslain' OR 'serial_experiments_lain' OR 'シリアルエクスペリメンツレイン' OR クラブサイベリア -rt -filter:images lang:ja"]);
        $datas['words'] = $statuses->statuses;

        // $datas['words'] = [
        //     ['text' => 'wired', 'url' => ''],
        //     ['text' => '橘総研', 'url' => ''],
        //     ['text' => 'lain', 'url' => ''],
        //     ['text' => 'レイン', 'url' => ''],
        //     ['text' => '岩倉玲音', 'url' => ''],
        //     ['text' => 'れいん', 'url' => ''],
        //     ['text' => 'プシューケ', 'url' => ''],
        //     ['text' => 'アクセラ', 'url' => ''],
        //     ['text' => 'タロウ氏ね', 'url' => ''],
        //     ['text' => 'ナイツ', 'url' => ''],
        //     ['text' => 'シューマン共鳴', 'url' => ''],
        //     ['text' => 'ロズウェル事件', 'url' => ''],
        //     ['text' => '英利政美', 'url' => ''],
        //     ['text' => '神', 'url' => ''],
        //     ['text' => '連続実験', 'url' => ''],
        //     ['text' => 'Copland OS', 'url' => ''],
        //     ['text' => 'NAVI', 'url' => ''],
        //     ['text' => 'お父さん', 'url' => ''],
        //     ['text' => 'ピケちゃん', 'url' => ''],
        //     ['text' => 'ガッチャ', 'url' => ''],
        // ];

        return view('media', $datas);
    }
}
