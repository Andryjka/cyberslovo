<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Arsenal:700|PT+Serif&display=swap&subset=cyrillic" rel="stylesheet">
    
    <title>@if(isset($meta['title'])){{ $meta['title'] }}@else @yield('title')@endif</title>
    <meta name="description" content="@if(isset($meta['meta_description'])){{$meta['meta_description'] }}@else @yield('meta_description')@endif">
    <meta name="keywords" content="@if(isset($meta['meta_keywords'])){{ $meta['meta_keywords'] }}@else @yield('meta_keywords')@endif">
    <link rel="alternate" type="application/rss+xml" title="RSS-лента / CYBERSLOVO - Эксклюзивные новости киберспорта, авторские интервью, аналитика, репортажи." href="https://cyberslovo.ru/rss">
    @yield('twitter_card')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightcase.css') }}" rel="stylesheet">
    @yield('header-other')

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <meta name="google-site-verification" content="8Hpp1YnEOGjLTbe1jTkXtJHNyyccbh3uAuKLy63Y3Ik" />
    <meta name="yandex-verification" content="237be66103eecec9" />

</head>
<body>
    <header>
        <div class="container d-flex header-block d-none d-sm-flex d-md-flex p-0">
            <div class="navbar navbar-expand-lg justify-content-around d-none d-sm-flex d-md-flex p-0">
                <a style="text-decoration: none;" class="navbar-brand" href="/">
                    <img class="logo-main" src="{{asset('/images/logo_main.png')}}" alt="Логотип Cyberslovo.ru">
                </a>
                <div class="navbar-nav">
                    <li class="nav-item pr-4">
                        <a class="nav-link" href="/category/news">НОВОСТИ</a>
                    </li>
                    <li class="nav-item pr-4">
                        <a class="nav-link" href="/category/interviews">ИНТЕРВЬЮ</a>
                    </li>
                    <li class="nav-item pr-4">
                        <a class="nav-link" href="/category/media">ТЕКСТЫ</a>
                    </li>
                    <li class="nav-item pr-4">
                        <a class="nav-link" href="/insider">#<span style="color: #B00000;">Я</span>ИНСАЙДЕР</a>
                    </li>
                    <li class="nav-item pr-5">
                        <a onclick="ym(54323388, 'reachGoal', 'telegram'); return true;" style="color: #B00000;" class="nav-link" href="https://tele.click/cyberslovo">TELEGRAM CYBERSLOVO</a>
                    </li>
                    <li class="nav-item text-right"><a id="search-button" style="cursor:pointer;"><i style="padding-top:10px;" class="fa fa-search" aria-hidden="true"></i>
</a></li>
                </div>
            </div>
        </div>
        <div class="overlay">
            <nav class="overlayMenu">  
                <ul role="menu">
                    <li><a href="/category/news" role="menuitem">Новости</a></li>
                    <li><a href="/category/interviews" role="menuitem">Интервью</a></li>
                    <li><a href="/category/media" role="menuitem">ТЕКСТЫ</a></li>
                     <li><a href="/short" role="menuitem">#<span style="color: #B00000;">В</span>КУРСЕ</a></li>
                    <li><a href="/insider" role="menuitem">#<span style="color: #B00000;">Я</span>ИНСАЙДЕР</a></li>
                    <li><a href="https://tele.click/cyberslovo" role="menuitem">НАШ TELEGRAM</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div style="margin-bottom: 30px;" class="container d-block d-sm-none d-md-none d-lg-none">
        <div class="row">
            <div class="col-6">
                <a class="mobile-nav-link" href="/">CYBERSLOVO</a>
            </div>
            <div class="col-6 text-right">
                <div class="navBurger d-block" role="navigation" id="navToggle"></div>
            </div>
        </div>
    </div>
    
</header>
<main role="main" class="container">
    <div id='app'></div>
    <div class="row">
        @yield('content')
    </div>
</main>


<div id="search-overlay" class="search-overlay">
    <div class="d-flex justify-content-center align-items-center">
        <div class="row">
            <a id="search-button__close" class="search-close__button"><i class="fa fa-times" aria-hidden="true"></i></a>
            <form action="{{route('search')}}" method="post">
                {{ csrf_field() }}
                <input class="search-overlay__input" name="search_query" type="text" class="form-control" placeholder="что ищете?" autocomplete="off"><br>
                <button type="submit" class="search-overlay__button">найти что-нибудь</button>
            </form>
        </div>
    </div>
</div>

<script src="{{asset('node_modules/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('js/app.js') }}"></script>
<script src="{{asset('js/common.js') }}"></script>
<script src="{{asset('js/lightcase.js') }}"></script>

 <script type='text/javascript'> 
    $(document).ready(function() { 
      $("a#search-button").click(function(){
        $('#search-overlay').fadeIn();
        $('#search-overlay').css('display','flex');
      });
      $("a#search-button__close").click(function(){
        $('#search-overlay').fadeOut();
        //$('#search-overlay').css('display','none');
      });
    });
</script> 




@yield('footer-other')

<!-- Yandex.Metrika counter -->
<script async type="text/javascript">
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(54323388, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/54323388" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-83941547-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-83941547-4');
</script>

<!--LiveInternet counter--><script type="text/javascript">
document.write('<a href="//www.liveinternet.ru/click" '+
'target="_blank"><img style="display:none;" src="//counter.yadro.ru/hit?t38.6;r'+
escape(document.referrer)+((typeof(screen)=='undefined')?'':
';s'+screen.width+'*'+screen.height+'*'+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+';u'+escape(document.URL)+
';h'+escape(document.title.substring(0,150))+';'+Math.random()+
'" alt="" title="LiveInternet" '+
'border="0" width="31" height="31"><\/a>')
</script><!--/LiveInternet-->

</body>
</html>
