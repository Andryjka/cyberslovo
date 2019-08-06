@extends('admin.app')

@section('content')

<div class="container mb-5">
    @component('admin.components.breadcrumbs')
        @slot('title') Создание материала @endslot
        @slot('parent') Главная @endslot
        @slot('active') Материалы @endslot
    @endcomponent
    <hr>


    <form action="{{route('admin.today.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include('admin.today.partials.form')
        <button class="btn btn-primary" type="submit">Сохранить материал</button>

        <input type="hidden" name="created_by" value="{{Auth::id()}}">
    </form>
</div>
@endsection