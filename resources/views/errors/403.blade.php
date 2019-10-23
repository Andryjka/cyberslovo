@extends('admin.app')


@section('content')

@extends('errors::minimal')

@section('title', __('Вход запрещен'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Вход запрещен'))

@endsection
