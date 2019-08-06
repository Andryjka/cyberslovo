@extends('admin.app')

@section('content')

<div class="container mb-5">
    @component('admin.components.breadcrumbs')
        @slot('title') Редактирование материала @endslot
        @slot('parent') Главная @endslot
        @slot('active') Список новостей @endslot
    @endcomponent
    <hr>


    <form action="{{route('admin.today.update', $today)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        @include('admin.today.partials.form')
        <button class="btn btn-primary" type="submit">Обновить новость</button>
    </form>
</div>

@endsection