<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
    @include('include.ga')

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>橘総研</title>

        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/corp.css') }}" rel="stylesheet">
    </head>
    <body>
    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            <img src="{{ asset('img/common/icon-re.png') }}" width="55">
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#">
            橘総研
            </a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
            <!-- <a class="text-muted" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
            </a>
            <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a> -->
          </div>
        </div>
      </header>

      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
          <a class="p-2" href="#navi">NAVI</a>
          <a class="p-2" href="#handnavi">Hand NAVI</a>
          <a class="p-2" href="#os">Copland OS</a>
          <a class="p-2 text-muted" href="" style="pointer-events: none;">Processors</a>
          <a class="p-2 text-muted" href="" style="pointer-events: none;">Boards</a>
          <a class="p-2 text-muted" href="" style="pointer-events: none;">Memory</a>
          <a class="p-2" href="/op">WIRED</a>
          <a class="p-2 text-muted" href="" style="pointer-events: none;">Support</a>
          <a class="p-2" href="#aboutus">About Us</a>
          <a class="p-2 text-muted" href="" style="pointer-events: none;">Contact Us</a>
          <a class="p-2 text-muted" href="" style="pointer-events: none;">Shopping</a>
        </nav>
      </div>

      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark starimg" id="os">
        <div>
        <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic">Copland OS Enterprise</h1>
          <p class="lead my-3">version 4.2 New Release</p>
          <p class="lead my-3">ワイヤードに新しい時代が訪れる</p>
          <p class="lead mb-0"><a href="#" style="pointer-events: none;" class="text-white font-weight-bold">詳細はこちら</a></p>
        </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-md-6" id="navi">
          <div class="card flex-md-row mb-4 box-shadow h-lg-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">NAVI</strong>
              <h3 class="mb-0">
                <a class="text-dark" href="#">Copland OS</a>
              </h3>
              <div class="mb-1 text-muted">v4.2 エンタープライズ版</div>
              <p class="card-text mb-auto">7月7日に販売決定したCopland OSの最新版。
              ワイヤードへのリアルタイムレンダリングで全身投影もストレスフリーで実現可能</p>
              
              <a href="" style="pointer-events: none;">製品詳細はこちら</a>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" src="{{ asset('img/common/icon-thumb.png') }}" alt="Card image cap">
          </div>
        </div>
        <div class="col-md-6" id="handnavi">
          <div class="card flex-md-row mb-4 box-shadow h-lg-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-success">Hand NAVI</strong>
              <h3 class="mb-0">
                <a class="text-dark" href="#">Copland OS</a>
              </h3>
              <div class="mb-1 text-muted">v2.1 モバイル向けパーソナル版</div>
              <p class="card-text mb-auto">手のひらに収まるサイズのNAVIで、制限付きでワイヤードへの接続機能が付きました。<br>メールなど従来の機能もより快適に！</p>
              <a href="#" style="pointer-events: none;">製品詳細はこちら</a>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" src="{{ asset('img/common/icon-thumb-re.png') }}" alt="Card image cap">
          </div>
        </div>
      </div>
    </div>

    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <h3 class="pb-3 mb-4 font-italic border-bottom">
            serial experiments
          </h3>

          <div class="blog-post">
            <h2 class="blog-post-title">WIRED</h2>

            <p><a href="/op" class="connect-wired"><img src="{{ asset('../img/text/connect-wired-hover.png') }}" alt="connect wired"></a></p>

            <ul>
            <li><a href="/twitter">wired ver.1</a></li>
            <li><a href="/wired">wired ver.2</a></li>
            </ul>
          </div><!-- /.blog-post -->

          <div class="blog-post">
            <h2 class="blog-post-title">新製品発表</h2>
            <p class="blog-post-meta">April 16 by <a href="#" style="pointer-events: none;">英利 政美 主任研究員</a></p>

            <p>3年前に発表されたCopland OSは人類をワイヤードという次元に接続させるインターフェイスとして偏在するまでに至った。今回の新しいバージョンでは、ワイヤードとリアルワールドの境界を限りなくゼロに近いものにしている。既にワイヤードは、リアルワールドの上位階層になりつつあり、そのワイヤードで＄＆＄％＆’＄管理すｊ＆（・。在とし）’・＋＃％＋＊｛｜”％//・辞めてやる辞めてやるこんな会社ヤメテやr</p>
          </div><!-- /.blog-post -->

        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
          <div class="p-3 mb-3 bg-light rounded" id="aboutus">
            <h4 class="font-italic">About Us</h4>
            <p class="mb-0">橘総研＜Tachibana-Lab＞<br>
            次世代OSであるCopland OSの開発を始め、ワイヤードとリアルワールドを接続し、ユビキタス社会を作り出すことを目指します。
          </p>
          </div>


          <div class="p-3">
            <h4 class="font-italic">Event Link</h4>
            <ol class="list-unstyled">
              <li><a href="https://mousou0322.wixsite.com/club-cyberia" class="club-cyberia" target="_blank"><img src="{{ asset('../img/text/club-cyberia-hover.png') }}" alt="club cyberia"></a><br>
            <br>
            Present　Day<br>
2018/07/07（sat）<br>
<br>
Present　Time<br>
OPEN　13：00　START　13：30<br>
CLOSE　21：00
</li>
            </ol>
          </div>
        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </main><!-- /.container -->

    <footer class="blog-footer">
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    </body>
</html>
