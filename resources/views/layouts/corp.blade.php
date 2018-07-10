<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
    @include('include.ga')

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>橘総合研究所 Tachibana-Lab</title>

        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/corp.css') }}" rel="stylesheet">

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@96kuroguro" />
        <meta property="og:url" content="{{url('/')}}" />
        <meta property="og:title" content="橘総合研究所 Tachibana-Lab" />
        <meta property="og:description" content="serial experiments lain 20周年を記念したファンサイトです。内容は適当なのであしからず。ただし、イベント情報は本当です、嘘じゃありません。" />
        <meta property="og:image" content="{{ asset('img/common/logo_bg.jpg') }}" />
    </head>
    <body>
    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-2 pt-1">
            <img src="{{ asset('img/common/icon-re.png') }}" width="55">
          </div>
          <div class="col-8 text-center">
            <a class="blog-header-logo text-dark" href="#">
            橘総合研究所
            </a><br>
            Tachibana-Lab
          </div>
          <div class="col-2 d-flex justify-content-end align-items-center">
            <!-- <a class="text-muted" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
            </a>
            <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a> -->
          </div>
        </div>
      </header>

      @include('include.menu')



    <main role="main" class="container">
      <div class="row">
      
        <div class="col-md-8 blog-main border-bottom border-dark">
          @yield('content')
        </div>

        @include('include.sidebar')

      </div><!-- /.row -->

    </main><!-- /.container -->

    <footer class="blog-footer">
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    @yield('js')
    </body>
</html>
