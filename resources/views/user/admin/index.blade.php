@extends('adminlte::page')

@section('title', 'ユーザー管理')

@section('content_header')
    <h1>ユーザー管理</h1>
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
      <th scope="col">管理者権限</th>
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
            @if($user->id === auth()->id() || $user->id == 1)
                <div><i class="fas fa-user-check" style="color: #007bff;"></i></div>
            @else
                <form action="{{ route('admin/put') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <label class="admin">
                        <button type="submit" class="admin-btn"  onclick='return confirm("ID:{{ $user->id }}の管理者権限を変更しますか？")'></button>
                        @if($user->role_id === 1)
                            <div><i class="fas fa-user-check" style="color: #007bff;"></i></div>
                        @else
                            <div><i class="fas fa-user"></i></div>
                        @endif
                    </label>
                </form>
            @endif
        </td>
        <td>
            @if($user->id !== auth()->id() && $user->id !== 1)
                <form action="{{ route('admin/delete/{user_id}', ['user_id' => $user->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger" type="submit" onclick='return confirm("本当に削除しますか？")'>削除</button>
                </form>
            @endif
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