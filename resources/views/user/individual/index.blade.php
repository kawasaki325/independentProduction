@extends('adminlte::page')

@section('title', 'プロフィール')

@section('content_header')
    <h1>{{$user->name}}さんのプロフィール</h1>
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

<div>
    <div class="js-follow-count d-flex align-items-center">
        <div class="follow-text mr-2">フォロー中</div>
        <div class="follow-count mr-4">{{ $follow_count }}</div>
        <div class="follow-text mr-2">フォロワー</div>
        <div class="follow-count js-followed-count">{{ $followed_count }}</div>
    </div>

    <div class="js-follow mt-3"  data-user-id="{{ $user->id }}" data-follow-id="{{ $user->follow_id }}">
        @if(isset($user->follow_id))
            <button class="btn btn-primary btn-sm">フォローを外す</button>
        @else
            <button class="btn btn-primary btn-sm btn-reverse">フォローする</button>
        @endif
    </div>

    <div class="d-flex mt-3">
        <div>
            <button class="btn btn-primary btn-sm btn-reverse"><a href="{{ route('individual/postIndex/{user_id}', ['user_id' => $user->id]) }}" class="text-white">投稿一覧</button>
        </div>
    
        <div class="ml-4">
        <button class="btn btn-primary btn-sm btn-reverse mb-3"><a href="{{ route('share') }}" class="text-white">戻る</button>
        </div>
    </div>

</div>




@stop

@section('css')
@stop

@section('js')
<script src="{{ asset('js/follow.js') }}"></script>
@stop