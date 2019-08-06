@extends('admin.app')

@section('content')
<div class="col-8">
	<h2 style="margin-bottom: 50px;">Личный кабинет</h2>
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<form action="{{route('user.update', $user)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('patch') }}

		<div class="form-group">
			<label for="">Никнейм</label>
			<input type="text" class="form-control" name="username" value="{{$user->username ?? ""}}" required>
		</div>

		<div class="form-group">
			<label for="">Имя</label>
			<input type="text" class="form-control" name="name" value="{{$user->name ?? ""}}" required>
		</div>

		<div class="form-group">
			<label for="">Фамилия</label>
			<input type="text" class="form-control" name="surname" value="{{$user->surname ?? ""}}" required>
		</div>

		<div class="form-group">
			<label for="">Обо мне</label>
			<textarea type="text" class="form-control" name="about" required>{{$user->about ?? ""}}</textarea> 
		</div>

		<button class="btn btn-primary" type="submit">Обновить данные</button>
	</form>
</div>
@endsection