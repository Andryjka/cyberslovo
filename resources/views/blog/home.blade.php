@extends('layouts.app')


@section('header-other')
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endsection


@section('content')
@php $counter = 5; @endphp

@if($today_news)
<div class="vkurse-cards">
    @forelse($today_news as $today)
    <div style="padding-right: 7px; padding-left: 7px;" class="col-12 col-sm-12 col-md-12 col-lg-4">
        <a href="/short" style="text-decoration: none;">
            <div id="today-block" class="vkurse-cards__card d-flex" style="@if($today->image) background: url('{{ $today->image }}'); @elseif($today->color) background-color: {{$today->color}} @endif">
                <span class="vkurse-card__header">{!!$today->card_icon!!}</span>
                <span class="info-today">{{$today->today}}</span>
                @if($today->title)<h2 class="today-title">{{$today->title}}</h2> @endif
                <p class="info-text" class="info-text">{{$today->description}}</p>
                <span class="info-source">{{$today->source}}</span>
            </div>
        </a>
    </div>
    @empty
    @endforelse
</div>
@endif


<div id="main-content"> 
    @forelse($articles as $article)
    <div id="article" style="padding-right: 7px; padding-left: 7px;" class="col-12 col-sm-12 col-md-12 @if($counter <= 3) col-lg-4 @else col-lg-6 @endif">
        <a style="text-decoration: none;" href="{{route('article', $article->slug)}}">
            <div class="post-inside-block d-flex">
                <div class="post-image flex-column" style="background: url('{{ $article->image }}');  @if($counter <= 3) height: 500px; @endif">
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
                        {{ $value->title }}
                        @endforeach
                    </span>
                    <h2 @if($counter <= 3) style="bottom: 20px; position: absolute; font-size: 1.3rem; padding-right: 10px; padding-left: 10px;" @endif>{{$article->title}}</h2>
                </div>
            </div>
        </a>
    </div>
    @php $counter--; if($counter == 0){ $counter = 5; } @endphp
    @empty
    <h2 class="text-center">Новостей нет</h2>
    @endforelse
</div>
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-4">
            {{ $articles->links('blog.components.pagination') }}
        </div>
    </div>
</div>

<div style="margin-top:100px;" class="container"></div>
@endsection

@section('footer-other')
<script type="text/javascript">
    
    $(function() {
        var count = 2;
        $('body').on('click', '#nextPage', function(e) {
            e.preventDefault();

/*            $('#load a').css('color', '#dfecf6');
            $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');*/
            var url = 'https://cyberslovo.ru/?page=';
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
                alert('Новостей больше нет');
            });
        }
    });
</script>

<script type="text/javascript">
    $(function(){
        $('.vkurse-cards__card').mouseenter(function(){
            var i = $('.vkurse-cards__card').index(this);
            if($('vkurse-cards__card').eq(i)){
                $('.today-title').eq(i).hide();
                $('.info-text').eq(i).show();
            }
            $('.vkurse-cards__card').mouseleave(function(){
                $('.today-title').eq(i).show();
                $('.info-text').eq(i).hide();
            });
            /*$('#today-title').hide().not($('#today-text').eq(i).show()).hide()*/
        });
    });
</script>
    
@endsection