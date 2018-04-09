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

        $statuses = $connection->get("search/tweets", ["count" => 100, "q" => "クラブサイベリア -rt"]);
        $search = $statuses->statuses;

        $statuses = $connection->get("statuses/user_timeline", ["count" => 3, "screen_name" => "se_lain_bot"]);
        $bot = $statuses;

        $tweets = array_merge($search, $bot);

        $tweets = json_decode(json_encode($tweets), true);
        foreach($tweets as $key => $value)
        {
            $id[$key] = $value['id'];
        }
        array_multisort($id, SORT_DESC, SORT_REGULAR, $tweets);


        return view('twitter', ['tweets' => $tweets]);
    }

}
