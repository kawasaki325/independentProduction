@extends('adminlte::page')

@section('title', 'プロフィール編集')

@section('content_header')
    <h1>プロフィール編集</h1>
@stop

@section('content')


@if(session('feedback.success'))
    <p style="color: green;">{{ session('feedback.success') }}</p>
@endif

@if (count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('user/put/{user_id}', ['user_id' => $user->id]) }}" method="post">
    @method('PUT')
    @csrf
    <p class="font-weight-bold mb-0 mt-4">名前</p>
    <input type="text" class="form-control" name="name" placeholder="名前" value="{{ $user->name }}" autofocus>
    <p class="font-weight-bold mb-0 mt-4">メールアドレス</p>
    <input type="email" class="form-control" name="email" placeholder="メールアドレス" value="{{ $user->email }}">
    <p class="font-weight-bold mb-0 mt-4">パスワード</p>
    <input type="password" class="form-control" name="password" placeholder="パスワード" >
    <p class="font-weight-bold mb-0 mt-4">パスワード確認</p>
    <input type="password" class="form-control" name="password_confirmation" placeholder="パスワード確認" >

    <div>
        <button type="submit" class="btn btn-primary mt-4">編集する</button>
    </div>
</form>
@stop

@section('css')
@stop