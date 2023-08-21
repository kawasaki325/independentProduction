@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>プラン確認</h1>
@stop

@section('content')


@if(!($goal->user->id === $user->id))
    <div>
        <div class="like js-like" data-user-id="{{ $goal->user->id }}" data-goal-id="{{ $goal->id }}" data-like-id="{{ $goal->like_id }}">
            @if(isset(  $tweet->like_id  ))
                <!-- いいね！している場合 -->
                <button>いいねを外す</button>
            @else
                <!-- いいね！していない場合 -->
                <button>いいねする</button>
            @endif
        </div>
        <div class="like-count js-like-count">{{ count($goal->likedByUsers) }}</div>
    </div>
@endif



@if(session('feedback.success'))
    <p style="color: green;">{{ session('feedback.success') }}</p>
@endif

<div class="myPlan">
    <div class="myPlan-header">
        <div class="myPlan-title">{{ $goal->content }}</div>
        <div class="myPlan-date">{{ $goal->date }}</div>
    </div>
    @for($i = 0; $i < count($goal->places); $i++)
        <div class="myPlan-body">
            <div class="myPlan-place ml-5">{{ $goal->places[$i]->content }}</div>
            <div class="myPlan-time ml-3">{{ $goal->times[$i]->time }}</div>
        </div>
        <div class="myPlan-memo">
            {!! nl2br(e($goal->places[$i]->memo->content)) !!}
            <br>
            @if($i != count($goal->places) - 1)
                {{ $goal->prices[$i]->amount }}
            @endif
        </div>
    @endfor
</div>

@stop

@section('js')
<script src="{{ asset('js/like.js') }}"></script>
@stop

@section('css')
<style>
    .myPlan-header {
        display: flex;
    }

    .myPlan-body {
        display: flex;
        position: relative;
    }

    .myPlan-body:before {
        content: "";
        width: 1em;
        height: 1em;
        border-radius: 50%;
        background: black;
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
    }

    .myPlan-memo {
        min-height: 20px;
        padding: 20px 0 20px 20px;
        position: relative;
        
    }

    .myPlan-memo:last-child:before {
        display:none;
    }

    .myPlan-memo:before {

        content: "";
        width: 1px;
        height: 110%;
        background: black;
        position: absolute;
        top: 50%;
        left: 7px;
        transform: translateY(-50%);
    }
</style>
@stop