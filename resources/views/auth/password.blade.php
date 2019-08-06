@extends('admin.app')

@section('content')
<div class="col-8">
	<h2 style="margin-bottom: 50px;">Изменение пароля</h2>
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	@if(Session::has('flash_message'))
		<div class="alert alert-success" role="alert">
			{{ session('flash_message') }}
		</div>
	@endif
	<form action="{{route('user_password.update', $user)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('patch') }}
		<div class="form-group">
			<label for="">Пароль</label>
			<input type="password" class="form-control" name="password" required>
		</div>

		<div class="form-group">
			<label for="">Подтвердите пароль</label>
			<input type="password" class="form-control" name="password_confirmation" required> 
		</div>

		<button class="btn btn-primary" type="submit">Обновить пароль</button>
	</form>

</div>
@endsection