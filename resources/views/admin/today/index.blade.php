@extends('admin.app')

@section('content')

<div id="app" class="container">
    @component('admin.components.breadcrumbs')
        @slot('title') Список новостей дня @endslot
        @slot('parent') Главная @endslot
        @slot('active') Новости дня @endslot
    @endcomponent
    <hr>

    <a href="{{route('admin.today.create')}}" class="btn btn-primary pull-right mb-3">
    <i class="fa fa-plus-square-o"></i>  &#160;Добавить новость</a>
    <table class="table table-striped">
        <thead>
            <th>Заголовок</th>
            <th>Инфоповод</th>
            <th class="d-none d-sm-block">Статус</th>
            <th class="d-none d-sm-block">Позиция на сайте</th>
            <th>Управление</th>
        </thead>
        <tbody>
            @forelse($today_news as $today)
                <tr>
                    <td>{{$today->title}}</td>
                     <td>{{$today->today}}</td>
                    <td class="d-none d-sm-block">
                        @if($today->published == 0)
                        Не опубликовано
                        @else
                        Опубликовано
                        @endif
                    </td>
                    <td class="d-none d-sm-block">@if($today->sort != 10){{$today->sort + 1}} @endif</td>
                    <td class="align-middle text-right">
                        <a class="btn" href="{{route('admin.today.edit', $today) }}"><i class="fa fa-edit"></i></a>
                        <form action="{{route('admin.today.destroy', $today)}}" onsubmit="if(confirm('Вы действительно хотите удалить?')){return true}else{return false}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}
                            <button class="btn" style ="border:transparent; background:transparent;" type="submit"><i class="fa fa-trash"></i></button>
                        </form>   
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        {{$today_news->links()}}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection