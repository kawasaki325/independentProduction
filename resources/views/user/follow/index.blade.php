@extends('adminlte::page')

@section('title', 'フォロー一覧')

@section('content_header')
    <h1>フォロー一覧</h1>
@stop

@section('content')


@if(session('feedback.success'))
    <p style="color: green;">{{ session('feedback.success') }}</p>
@endif

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">名前</th>
      <th scope="col">メールアドレス</th>
      <th scope="col">登録日</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
        <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
        <td >
            <button class="btn btn-primary btn-sm btn-reverse mb-3"><a href="{{ route('individual/{user_id}', ['user_id' => $user->id]) }}" class="text-white">プロフィール</a></button>
        </td>
        <td>

        </td>

        </tr>
    @endforeach
  </tbody>
</table>

@stop

@section('css')
    <style>
        .admin-btn {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .admin {
            cursor: pointer;
        }
    </style>
@stop