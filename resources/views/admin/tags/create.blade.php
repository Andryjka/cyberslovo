@extends('admin.app')

@section('content')

<div class="container">
    @component('admin.components.breadcrumbs')
        @slot('title') Создание тега @endslot
        @slot('parent') Главная @endslot
        @slot('active') Теги @endslot
    @endcomponent
    <hr>


    <form action="{{route('admin.tags.store')}}" class="form-horizontal" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Один или несколько тегов через запятую, последний тег без запятой!!!">
        </div>
        <button class="btn btn-primary" type="submit">Добавить тэги</button>

        <input type="hidden" name="created_by" value="{{Auth::id()}}">
    </form>
</div>

<div class="mb-5"></div>
@endsection