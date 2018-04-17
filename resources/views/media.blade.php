<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
@include('include.ga')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>wiredに遍在するGraphic</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/twitter.css') }}" rel="stylesheet">
</head>
<body>
<div id="holder"></div>
<script src='{{ asset('js/plugins/jquery.svg3dtagcloud.min.js') }}'></script>
<script>
var entries = [ 
   @foreach($medias as $tweet)
   @if(isset($tweet->extended_entities))
   @php
   $media = $tweet->extended_entities->media[0];
   @endphp
    { image: '{{ $media->media_url_https }}', width: '{{ $media->sizes->small->w / 3 }}', height: '{{ $media->sizes->small->h / 3 }}', url: '{{ $media->expanded_url }}', target: '_top' },
   @endif
   @endforeach

];

var settings = {

    entries: entries,
    width: '100%',
    height: '100%',
    radius: '65%',
    radiusMin: 75,
    bgDraw: true,
    bgColor: '#111',
    opacityOver: 1.00,
    opacityOut: 0.05,
    opacitySpeed: 6,
    fov: 800,
    speed: 0.5,
    fontFamily: 'Oswald, Arial, sans-serif',
    fontSize: '15',
    fontColor: '#fff',
    fontWeight: 'normal',//bold
    fontStyle: 'normal',//italic 
    fontStretch: 'normal',//wider, narrower, ultra-condensed, extra-condensed, condensed, semi-condensed, semi-expanded, expanded, extra-expanded, ultra-expanded
    fontToUpperCase: true,
    tooltipFontFamily: 'Oswald, Arial, sans-serif',
    tooltipFontSize: '11',
    tooltipFontColor: '#fff',
    tooltipFontWeight: 'normal',//bold
    tooltipFontStyle: 'normal',//italic 
    tooltipFontStretch: 'normal',//wider, narrower, ultra-condensed, extra-condensed, condensed, semi-condensed, semi-expanded, expanded, extra-expanded, ultra-expanded
    tooltipFontToUpperCase: false,
    tooltipTextAnchor: 'left',
    tooltipDiffX: 0,
    tooltipDiffY: 10

};
$( '#holder' ).svg3DTagCloud( settings );
</script>
</body>
</html>
