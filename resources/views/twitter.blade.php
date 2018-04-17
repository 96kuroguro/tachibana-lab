@extends('layouts.twitter')

@section('title', '玲音とレインとlainとれいん')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <a href="/">
                HOME
            </a>
        </div>
    </div>

    <div class="row justify-content-center">


<div class="col-md-4">
    <h3>メディア</h3>
    @foreach($arts as $tweet)
            <div class="card mb-2">
            @if(isset($tweet->extended_entities))
                            @foreach($tweet->extended_entities->media as $media)
                            <img src="{{$media->media_url}}" class="card-img-top">
                            @endforeach
                        @endif
                <div class="card-body row">
                    <div class="col-2">
                        <img class="rounded-circle" src="{{ $tweet->user->profile_image_url }}" alt="Card image cap">
                    </div>
                    <div class="col-10">
                        <p class="tweet">{!! $tweet->text !!}</p>
                        {{ date('Y/m/d H:i', strtotime($tweet->created_at)) }}
                    </div>
                </div>
            </div>
    @endforeach
</div>

<div class="col-md-4">
    <h3>serial experiments lain</h3>
    @foreach($lain as $tweet)
    <div class="card mb-2">
            @if(isset($tweet->extended_entities))
                            @foreach($tweet->extended_entities->media as $media)
                            <img src="{{$media->media_url}}" class="card-img-top">
                            @endforeach
                        @endif
                <div class="card-body row">
                    <div class="col-2">
                        <img class="rounded-circle" src="{{ $tweet->user->profile_image_url }}" alt="Card image cap">
                    </div>
                    <div class="col-10">
                        <p class="tweet">{!! $tweet->text !!}</p>
                        {{ date('Y/m/d H:i', strtotime($tweet->created_at)) }}
                    </div>
                </div>
            </div>
    @endforeach
</div>

<div class="col-md-4">
    <h3>クラブサイベリア</h3>
    @foreach($cyberia as $tweet)
    <div class="card mb-2">
            @if(isset($tweet->extended_entities))
                            @foreach($tweet->extended_entities->media as $media)
                            <img src="{{$media->media_url}}" class="card-img-top">
                            @endforeach
                        @endif
                <div class="card-body row">
                    <div class="col-2">
                        <img class="rounded-circle" src="{{ $tweet->user->profile_image_url }}" alt="Card image cap">
                    </div>
                    <div class="col-10">
                        <p class="tweet">{!! $tweet->text !!}</p>
                        {{ date('Y/m/d H:i', strtotime($tweet->created_at)) }}
                    </div>
                </div>
            </div>
    @endforeach
</div>

    </div>
</div>
@endsection

@section('js')
<script>
var autolinker = new Autolinker( {
    urls : {
        schemeMatches : true,
        wwwMatches    : true,
        tldMatches    : true
    },
    email       : false,
    phone       : false,
    mention     : 'twitter',
    hashtag     : 'twitter',

    stripPrefix : false,
    stripTrailingSlash : false,
    newWindow   : true,

    truncate : {
        length   : 0,
        location : 'middle'
    },

    className : ''
} );

// var myLinkedHtml = autolinker.link( "テキスト https://example.com テキスト" );

// console.log(myLinkedHtml);

$('.tweet').each(
    function(i, e){
        // console.log(i + ': ' + $(e).text());
        var html = autolinker.link( $(e).text() );
        $(this).html( html );
        
    }
);

</script>
@endsection