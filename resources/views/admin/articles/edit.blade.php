@extends('admin.app')

@section('content')

<div class="container mb-5">
    @component('admin.components.breadcrumbs')
        @slot('title') Редактирование материала @endslot
        @slot('parent') Главная @endslot
        @slot('active') Категории @endslot
    @endcomponent
    <hr>


    <form action="{{route('admin.article.update', $article)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        @include('admin.articles.partials.form')
        <button class="btn btn-primary" type="submit">Обновить материал</button>
        @if($article->slug)
        <a target="_blank" class="btn btn-primary btn-danger" href="/blog/{{$article->slug}}"> Предпросмотр</a>
        @endif
        <input type="hidden" name="modified_by" value="{{Auth::id()}}">
    </form>
</div>

@endsection