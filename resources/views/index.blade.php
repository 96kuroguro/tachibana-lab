@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <p class="split day" style="color:red;">プレゼント・デイ</p>
                    <p class="split time" style="color:red;">プレゼント・タイム</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(function(){

 
    $.wait = function(msec) {
        // Deferredのインスタンスを作成
        var d = new $.Deferred;

        setTimeout(function(){
            // 指定時間経過後にresolveしてdeferredを解決する
            d.resolve(msec);
        }, msec);

        return d.promise();
    };

    $.wait(2000)
    .then(function(ms){
        console.log(ms + "ミリ秒待ちました");
        // 次のコールバックに渡すために新たなdeferredを返却
        return $.wait(1000); 
        // 次のコールバックも同様のやり方でつなげばいくらつないでもネストはこれ以上下がらない
    })
    .done(function(ms){
        console.log(ms + "ミリ秒待ちました");
    });

        var setElm1 = $('.day');
        typewriter(setElm1);

        var setElm2 = $('.time');
        typewriter(setElm2);

    
    function typewriter(setElm, delaySpeed = 200, fadeSpeed = 0) {
        setText = setElm.html();
    
        setElm.css({visibility:'visible'}).children().addBack().contents().each(function(){
            var elmThis = $(this);
            if (this.nodeType == 3) {
                var $this = $(this);
                $this.replaceWith($this.text().replace(/(\S)/g, '<span class="textSplitLoad">$&</span>'));
            }
        });
        $(window).on('load',function(){
            splitLength = $('.textSplitLoad').length;
            setElm.find('.textSplitLoad').each(function(i){
                splitThis = $(this);
                splitTxt = splitThis.text();
                splitThis.delay(i*(delaySpeed)).css({display:'inline-block',opacity:'0'}).animate({opacity:'1'},fadeSpeed);
            });
            setTimeout(function(){
                    setElm.html(setText);
            },splitLength*delaySpeed+fadeSpeed);
        });
    }
});
</script>
@endsection