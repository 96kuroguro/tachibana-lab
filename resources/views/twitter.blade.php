@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    @php
        $i = 0;
    @endphp
    @foreach($tweets as $tweet)
        @if($i%3 == 0)
        <div class="card-deck mb-3">
        @endif
            <div class="card{{ $tweet['user']['screen_name'] == "se_lain_bot" ? " bg-warning": null }}">
                <div class="card-body row">
                    <div class="col-2">
                        <img class="rounded-circle" src="{{ $tweet['user']['profile_image_url'] }}" alt="Card image cap">
                    </div>
                    <div class="col-10">
                        {{ $tweet['text'] }}
                        {{ $tweet['created_at'] }}
                    </div>
                </div>
            </div>
        @if($i%3 == 2)
        </div>
        @endif
    @php
        $i++;
    @endphp
    @endforeach

    </div>
</div>
@endsection