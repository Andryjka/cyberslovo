@extends('admin.app')

@section('content')

<div class="container">
    @component('admin.components.breadcrumbs')
        @slot('title') Список категорий @endslot
        @slot('parent') Главная @endslot
        @slot('active') Категории @endslot
    @endcomponent
    <hr>

    <a href="{{route('admin.category.create')}}" class="btn btn-primary pull-right mb-3">
    <i class="fa fa-plus-square-o"></i> &#160;Создать категорию</a>
    <table class="table table-striped">
        <thead>
            <th>Наименование</th>
            <th>Публикации</th>
            <th>Действие</th>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{$category->title}}</td>
                    <td>{{$category->published}}</td>
                    <td class="align-middle text-right">
                        <a class="btn" href="{{route('admin.category.edit', $category) }}"><i class="fa fa-edit"></i></a>
                        <form action="{{route('admin.category.destroy', $category)}}" onsubmit="if(confirm('Вы действительно хотите удалить?')){return true}else{return false}" method="post">
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
                        {{$categories->links()}}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection