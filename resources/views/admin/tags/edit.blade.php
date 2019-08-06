@extends('admin.app')

@section('content')

<div class="container">
    @component('admin.components.breadcrumbs')
        @slot('title') Редактирование тэга @endslot
        @slot('parent') Главная @endslot
        @slot('active') Категории @endslot
    @endcomponent
    <hr>


    <form action="{{route('admin.tags.update', $tag)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="{{$tag->name}}">
        </div>
        <button class="btn btn-primary" type="submit">Обновить тэг</button>
        <input type="hidden" name="modified_by" value="{{Auth::id()}}">
    </form>
</div>
@endsection