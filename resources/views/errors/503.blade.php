@extends('errors::minimal')

@section('title', __('Сервис недоступен'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))
