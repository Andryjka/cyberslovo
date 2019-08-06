@extends('layouts.app')


@section('header-other')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endsection


@section('content')
<div class="d-none d-sm-block col-sm-12"><h1 class="vkurse__h1 text-center">#<span style="color:#B00000;">В</span>КУРСЕ - краткие новости дня</h1></div>

@foreach($short_news as $today)
<div class="d-none d-md-block col-md-2"></div>
	<div class="col-12 col-md-8">
		<div class="today-feed__card">
				@php
				$date = strtotime($today->created_at);
				$date = date('d.m.Y', $date);
				@endphp
			<span class="today-feed__info justify-content-center align-content-center">{{$today->today}} от <? echo $date ?></span>
			@if($today->photo_published == 1) <img src="{{$today->image}}" alt="{{$today->title}}"> @endif 
			<h2 class="today-feed__title">{{$today->title}}</h2>
			<p class="today-feed__text" class="info-text">{{$today->description}}</p>
			@if($today->description_feed)<div class="today-feed-padding__hr">
				<hr class="today-feed__hr">
			</div>
			@endif
			@if($today->description_feed)<p class="today-feed__text">{!! $today->description_feed !!}</p> @endif
			<span class="today-feed__source">Источник: {{$today->source}}</span>
		</div>
	</div>
<div class="d-none d-md-block col-md-2"></div>
@endforeach
<div class="container mb-5">
    <div class="row">
    	<div class="d-none d-md-block col-md-2"></div>
        <div class="col-12 col-md-8 d-flex justify-content-center mt-4">
            {{ $short_news->links('blog.components.pagination') }}
        </div>
        <div class="d-none d-md-block col-md-2"></div>
    </div>
</div>


@section('footer-other')
<script type="text/javascript">
    
    $(function() {
        var count = 2;
        $('body').on('click', '#nextPage', function(e) {
            e.preventDefault();

/*            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');*/
            var url = 'https://cyberslovo.ru/vkurse?page=';
            url = url.substring(0, url.length) + count;
            getArticles(url);
            count++;
           
        });

        function getArticles(url) {
            $.ajax({
                url : url  
            }).done(function (data) {
                var content = $(data);
                content = content.find('#article');
                $('#main-content').append(content);
                window.history.pushState("", "", 'https://cyberslovo.ru');
            }).fail(function () {
                alert('Articles could not be loaded.');
            });
        }
    });
</script>

<script src="{{asset('js/jquery.mobile-events.min.js')}}"></script>
<script type="text/javascript">

	var a = $('MAIN'),
	allImages = a.find('img'),
	imgSrc = [];
	allImages.wrap('<a id="lightcase" style="cursor: zoom-in" data-rel="lightcase" href="" />');
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
		$('a[data-rel^=lightcase]').lightcase({
			showTitle: false,
			swipe: true,
			showCaption: false,
			closeOnOverlayClick: false,
			fullScreenModeForMobile: true,
			fixedRatio: false,
			disableShrink: true,
		});
	});
</script>
@endsection


@endsection