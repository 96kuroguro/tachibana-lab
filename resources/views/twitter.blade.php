@extends('layouts.twitter')

@section('title', '玲音とレインとlainとれいん')

@section('content')
<div class="container">
    <div class="row justify-content-center">

<div class="col-md-4">
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
                        {{ $tweet->text }}
                        <br>
                        {{ date('Y/m/d H:i', strtotime($tweet->created_at)) }}
                    </div>
                </div>
            </div>
    @endforeach
</div>

<div class="col-md-4">
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
                        {{ $tweet->text }}
                        <br>
                        {{ date('Y/m/d H:i', strtotime($tweet->created_at)) }}
                    </div>
                </div>
            </div>
    @endforeach
</div>

<div class="col-md-4">
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
                        {{ $tweet->text }}
                        <br>
                        {{ date('Y/m/d H:i', strtotime($tweet->created_at)) }}
                    </div>
                </div>
            </div>
    @endforeach
</div>

    </div>
</div>
@endsection