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
        $statuses = $connection->get("search/tweets", ["count" => 10, "q" => "'serial experiments lain' OR 'serialexperimentslain' OR クラブサイベリア -rt filter:images"]);
        $datas['medias'] = $statuses->statuses;

        return view('media', $datas);
    }
}
