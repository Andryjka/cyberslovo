@extends('admin.app')

@section('content')

<div class="container">
    @component('admin.components.breadcrumbs')
        @slot('title') Список материалов @endslot
        @slot('parent') Главная @endslot
        @slot('active') Материалы @endslot
    @endcomponent
    <hr>


	<a href="{{route('admin.tags.create')}}" class="btn btn-primary pull-right mb-3">
    <i class="fa fa-plus-square-o"></i>  &#160;Добавить теги</a>
    <table class="table table-striped">
        <thead>
            <th>Наименование</th>
            <th>Управление</th>
        </thead>
        <tbody>
            @forelse($tags as $tag)
                <tr>
                    <td>{{$tag->name}}</td>
                    <td class="align-middle text-right">
                        <a class="btn" href="{{route('admin.tags.edit', $tag) }}"><i class="fa fa-edit"></i></a>
                        <form action="{{route('admin.tags.destroy', $tag)}}" onsubmit="if(confirm('Вы действительно хотите удалить?')){return true}else{return false}" method="post">
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
                        {{$tags->links()}}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>


</div>

@endsection