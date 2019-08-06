@extends('layouts.app')

@section('title', $article->meta_title)
@section('meta_keywords', $article->meta_keywords)
@section('meta_description', $article->meta_description)

@section('header-other')
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endsection

@section('twitter_card')
<meta name="twitter:card" content="summary">
<meta name="twitter:creator" content="@EtoVseGluposti">
<meta name="twitter:title" content="{{$article->title}}">
<meta name="twitter:description" content="{!! $article->description_short !!}">
<meta name="twitter:image" content="{{$article->image}}">
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:title" content="{{$article->title}}" />
<meta property="og:description" content="{!! $article->description_short !!}" />
<meta property="og:image" content="{{$article->image}}" />
<meta property="article:published_time" content="{{$article->created_at}}" />
@endsection

@section('content')
<div class="d-none d-md-block col-md-2"></div>
<div class="col-12 col-sm-12 col-md-8 background-node">
	<div class="post-image-article flex-column" style="background-image: url('{{ $article->image }}');">
		<span class="date-span">
			<?php
			$date = strtotime($article->created_at);
			$date = date('d F', $date);
			$rusDate = str_replace(
				array('january','february','march','april','may','june','july',
					'august','september','october','november','december'),
				array('января','февраля','марта','апреля','мая','июня','июля',
					'августа','сентября','октября','ноября','декабря'), strtolower($date));
			echo $rusDate;
			?>     
		</span>
		<span class="category-span">
			@foreach($article->categories as $value)
			<a href="@if($value->title == 'Новости') /category/news @elseif($value->title == 'Интервью') /category/interviews @else /category/media @endif">{{ $value->title }}</a>
			@endforeach
		</span>
		<h1>{{ $article->title }}</h1>
		<a class="zoom-in" href="{{$article->image }}" data-rel="lightcase:myCollection"><i style="font-size:1.6rem;"class="fa fa-search-plus" aria-hidden="true"></i></a>
		@if($article->source)
		<a class="source-link" href ="{{$article->source}}"><i class="fa fa-link mr-1" aria-hidden="true"></i>
			@php $url = parse_url($article->source); echo $url['host']; @endphp</a>
		@endif
	</div>
	<div class="blog-main">
		<div class="blog-post">
			{!! $article->description !!}
		</div>
		@unless($article->tags->isEmpty())<div class="tags-block">@foreach($article->tags as $tag)<a href="{{ route('articles.tags', $tag->name) }}"> {{ $tag->name}}</a> @endforeach</div> @endunless
		<h4>Читайте также:</h4>
		@foreach($news as $key => $value)
			@php $url = 'https://cyberslovo.ru/blog/'.$key; @endphp

			@if($url == Request::url())
				@continue
			@else
			<a style="font-size: 1.1rem;" href ="/blog/{{$key}}">{{$value}}</a><br>
			@endif

		@endforeach
		<h4 class="h4-share" style="margin-top: 20px;">Поделитесь новостью:</h4><div style="margin-bottom: 15px;" class="ya-share2" data-lang="ru" data-image="{{$article->image}}" data-services="vkontakte,facebook,odnoklassniki,twitter,telegram"></div>
		<div id="disqus_thread"></div>
		<script type="text/javascript" crossorigin="anonymous">
			(function() { 
				var d = document, s = d.createElement('script');
				s.src = 'https://cyberslovo-ru.disqus.com/embed.js';
				s.setAttribute('data-timestamp', +new Date());
				(d.head || d.body).appendChild(s);
			})();
		</script>
	</div>
</div>
<div class="d-none d-md-block col-md-2"></div>


<div class="d-none itemscope-instantview" itemscope itemtype="http://schema.org/NewsArticle">
	<span itemprop="name">{{ $article->title }}</span>
	<img itemprop="image" src="{{$article->image}}" alt="{{ $article->title }}">
	<span itemprop="description">{{ $article->description_short }}</span>
	<span class="date-itemprop" itemprop="dateCreated">{{$article->created_at}}</span>
	<span itemprop="author">CYBERSLOVO</span>
</div>	

@endsection

@section('footer-other')
<script src="{{asset('js/jquery.mobile-events.min.js')}}"></script>
<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js"></script>
<script type="text/javascript">

	var a = $('.blog-main'),
	allImages = a.find('img'),
	imgSrc = [];
	allImages.wrap('<a id="lightcase" style="cursor: zoom-in" data-rel="lightcase:myCollection" href="" />');
	$.each(allImages, function(value, index){
		imgSrc.push($(index).attr('src'));
	});

	allImages2 = a.find('a#lightcase');
	var count = 0;
	$.each(allImages2, function(value, index){
		$(index).attr('href', imgSrc[count]);
		count++;
	});
	
	jQuery(document).ready(function($) {
		$('a[data-rel^=lightcase\\:myCollection]').lightcase({
			showTitle: false,
			swipe: false,
			showCaption: false,
			closeOnOverlayClick: false,
			fullScreenModeForMobile: true,
			fixedRatio: false,
			disableShrink: true,
		});
	});
</script>
<script>
	(function() {
	    
	    var script,
	        scripts = document.getElementsByTagName('script')[0];
	        
	    function load(url) {
	      script = document.createElement('script');
	      script.async = true;
	      script.src = url;
	      scripts.parentNode.insertBefore(script, scripts);
	    }
	    
	    load('//apis.google.com/js/plusone.js');
	    load('//platform.twitter.com/widgets.js');
	    load('//cyberslovo-ru.disqus.com/embed.js')
	    
	}());
</script>
@endsection