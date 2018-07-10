@extends('layouts.corp')

@section('title', 'serial experiments lain ファンアートSS')

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        serial experiments lain ファンアートSS
    </h3>

    <h4>目次</h4>

    <p>Layer:01～08は、劇中に登場していないオリジナルキャラ。<br>
    layer:09～13は、劇中に登場した誰かです。（敢えて名前は出していませんがlainを観ていたらバレバレです）</p>

    <ul class="list-group">
        <li class="list-group-item">Layer:01　<a href="{{ url('ss/layer_01') }}">――メールを受け取った少女</a></li>
        <li class="list-group-item">Layer:02　<a href="{{ url('ss/layer_02') }}">――アクセラを流す男</a></li>
        <li class="list-group-item">Layer:03　<a href="{{ url('ss/layer_03') }}">――サイベリアの常連客</a></li>
        <li class="list-group-item">Layer:04　<a href="{{ url('ss/layer_04') }}">――ファントマと少年</a></li>
        <li class="list-group-item">Layer:05　<a href="{{ url('ss/layer_05') }}">――デートの約束をしていた女</a></li>
        <li class="list-group-item">Layer:06　<a href="{{ url('ss/layer_06') }}">――K.I.D.Sの研究員</a></li>
        <li class="list-group-item">Layer:07　<a href="{{ url('ss/layer_07') }}">――ハッキーな女</a></li>
        <li class="list-group-item">Layer:08　<a href="{{ url('ss/layer_08') }}">――のぞかれた教師</a></li>
        <li class="list-group-item">Layer:09　<a href="{{ url('ss/layer_09') }}">――橘総合研究所主任研究員</a></li>
        <li class="list-group-item">Layer:10　<a href="{{ url('ss/layer_10') }}">――父としての役割を持っていた男</a></li>
        <li class="list-group-item">Layer:11　<a href="{{ url('ss/layer_11') }}">――肉体を捨てた少女</a></li>
        <li class="list-group-item">Layer:12　<a href="{{ url('ss/layer_12') }}">――繋がってくれた友達</a></li>
        <li class="list-group-item">Layer:13　<a href="{{ url('ss/layer_13') }}">――私は遍在する</a></li>
    </ul>

    <p class="text-right">著：@96kuroguro</p>

@endsection

@section('js')
<script>
</script>
@endsection