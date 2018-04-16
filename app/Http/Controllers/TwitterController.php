<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
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
        $statuses = $connection->get("search/tweets", ["count" => 50, "q" => "'serial experiments lain' OR 'serialexperimentslain' -rt"]);
        $datas['lain'] = $statuses->statuses;

        //クラブサイベリア
        $statuses = $connection->get("search/tweets", ["count" => 50, "q" => "クラブサイベリア -rt"]);
        $datas['cyberia'] = $statuses->statuses;

        //絵ツイート
        $statuses = $connection->get("search/tweets", ["count" => 50, "q" => "'serial experiments lain' OR 'serialexperimentslain' OR クラブサイベリア -rt filter:images"]);
        $datas['arts'] = $statuses->statuses;

        //bot
        $statuses = $connection->get("statuses/user_timeline", ["count" => 3, "screen_name" => "se_lain_bot OR ps_lain_bot OR ps_touko_bot"]);
        $datas['bot'] = $statuses;

        // $tweets = array_merge($search, $bot);

        // $tweets = json_decode(json_encode($tweets), true);
        // foreach($tweets as $key => $value)
        // {
        //     $id[$key] = $value['id'];
        // }
        // array_multisort($id, SORT_DESC, SORT_REGULAR, $tweets);


        return view('twitter', $datas);
    }

}
