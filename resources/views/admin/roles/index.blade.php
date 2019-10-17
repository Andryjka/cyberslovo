@extends('admin.app')


@section('content')
<div id="app" class="container">
    @component('admin.components.breadcrumbs')
        @slot('title') Список групп @endslot
        @slot('parent') Главная @endslot
        @slot('active') Группы @endslot
    @endcomponent
    <hr>

    <a href="{{route('roles.create')}}" class="btn btn-primary pull-right mb-3">
    <i class="fa fa-plus-square-o"></i>  &#160;Добавить группу</a>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
  <tr>
     <th width="35px">№</th>
     <th>Имя группы</th>
     <th width="280px">Управление</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Редактировать</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline', "onsubmit" => "if(confirm('Вы действительно хотите удалить?')){return true}else{return false}"]) !!}
                    {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $roles->render() !!}


</div>
@endsection