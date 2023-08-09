@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>プラン確認</h1>
@stop

@section('content')

<a href="{{ route('update/create/{plan}', ['plan' => $goal->id]) }}">編集</a>
<form action="{{ route('update/delete/{plan}', ['plan' => $goal->id]) }}" method="post">
    @method('DELETE')
    @csrf
    <button type="submit" onclick='return confirm("本当に削除しますか？")'>削除</button>
</form>
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
        {{$goal->places[$i]->memo->content}}
        </div>
    @endfor
</div>

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

    .myPlan-body:after {
        content: "";
        width: 1px;
        height: 20px;
        background: black;
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
    }



</style>
@stop