@extends('adminlte::page')

@section('title', 'プロフィール')

@section('content_header')
    <h1>プロフィール</h1>
@stop

@section('content')


@if(session('feedback.success'))
    <p style="color: green;">{{ session('feedback.success') }}</p>
@endif

<div class="d-flex align-items-center mt-3">
    <p class="font-weight-bold">名前：</p>
    <p class="ml-3">{{ $user->name }}</p>
</div>
<div class="d-flex align-items-center mt-3">
    <p class="font-weight-bold">メールアドレス：</p>
    <p class="ml-3">{{ $user->email }}</p>
</div>

<button class="btn btn-primary mt-3"><a href="{{ route('user/create') }}" class="text-decoration-none text-white">編集する</a></button>



@stop

@section('css')
@stop