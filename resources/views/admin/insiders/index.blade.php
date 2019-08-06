@extends('admin.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-12">
			@foreach($insiders as $insider)
			<h2>{{ $insider->title }}</h2>
			<span><b>{{ $insider->author }}</b></span>
			<span>{{ $insider->created_at }}</span>
			<p>{!! $insider->description !!}</p>
			<form action="{{route('admin.insider.destroy')}}" onsubmit="if(confirm('Вы действительно хотите удалить?')){return true}else{return false}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$insider->id}}">
              	<button class="btn" style ="border:transparent; background:transparent;" type="submit"><i class="fa fa-trash"></i></button>
             </form> 
			<hr>
			@endforeach
			{{$insiders->links()}}
		</div>
	</div>
</div>


@endsection