@extends('layouts.main')

@section('title', 'プレゼント・デイ プレゼント・タイム')

@section('content')
<div class="container">
    <div class="day-wrap">
        <p class="day">プレゼント・デイ</p>
    </div>
    <div class="time-wrap">
        <p class="time">プレゼント・タイム</p>
    </div>

    <div class="enter">
        <a href="/twitter"><img src="{{ asset('../img/text/enter.png') }}" alt="Enter"></a>
    </div>

</div>
@endsection

@section('js')
<script>

</script>
@endsection