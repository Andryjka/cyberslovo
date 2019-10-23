@extends('admin.app')


@section('content')
<div id="app" class="container">
    @component('admin.components.breadcrumbs')
        @slot('title') Список пользователей @endslot
        @slot('parent') Главная @endslot
        @slot('active') Пользователи @endslot
    @endcomponent
    <hr>

    <a href="{{route('users.create')}}" class="btn btn-primary pull-right mb-3">
    <i class="fa fa-plus-square-o"></i>  &#160;Добавить пользователя</a>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th width="35px">№</th>
   <th>Никнейм</th>
   <th>E-mail</th>
   <th>Права доступа</th>
   <th width="280px">Управление</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label style="font-size: 90%;" class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
      <!-- onsubmit="if(confirm('Вы действительно хотите удалить?')){return true}else{return false}" -->
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Редактировать</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline', "onsubmit" => "if(confirm('Вы действительно хотите удалить?')){return true}else{return false}"]) !!}
            {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>

</div>
{!! $data->render() !!}

@endsection