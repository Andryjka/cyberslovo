@extends('admin.app')

@section('content')

<div class="container">
    @component('admin.components.breadcrumbs')
        @slot('title') Редактирование категории @endslot
        @slot('parent') Главная @endslot
        @slot('active') Категории @endslot
    @endcomponent
    <hr>


    <form action="{{route('admin.category.update', $category)}}" class="form-horizontal" method="post">
        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        @include('admin.categories.partials.form')
        <button class="btn btn-primary" type="submit">Сохранить</button>
    </form>
</div>
@endsection