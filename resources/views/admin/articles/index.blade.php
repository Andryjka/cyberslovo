@extends('admin.app')

@section('content')

<div id="app" class="container">
    @component('admin.components.breadcrumbs')
        @slot('title') Список материалов @endslot
        @slot('parent') Главная @endslot
        @slot('active') Материалы @endslot
    @endcomponent
    <hr>
    
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
          <p>{{ $message }}</p>
        </div>
    @endif

    <a href="{{route('admin.article.create')}}" class="btn btn-primary pull-right mb-3">
    <i class="fa fa-plus-square-o"></i>  &#160;Добавить материал</a>
    <table class="table table-striped">
        <thead>
            <th>Наименование</th>
            <th class="d-none d-sm-block">Статус</th>
            <th>Просмотры</th>
            <th>Автор</th>
            <th>Управление</th>
        </thead>
        <tbody>
            @forelse($articles as $article)
                <tr>
                    <td>{{$article->title}}</td>
                    <td class="d-none d-sm-block">
                        @if($article->published == 0)
                        Не опубликовано
                        @else
                        Опубликовано
                        @endif
                    </td>
                    <td><i class="fa fa-eye"></i> {{$article->viewed}}</td>
                    <td>{{$article->author->name}}</td>
                    <td class="align-middle text-right">
                        <a class="btn" href="{{route('admin.article.edit', $article) }}"><i class="fa fa-edit"></i></a>
                        <form action="{{route('admin.article.destroy', $article)}}" onsubmit="if(confirm('Вы действительно хотите удалить?')){return true}else{return false}" method="post">
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
                        {{$articles->links()}}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection