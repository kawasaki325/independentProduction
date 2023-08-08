@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>プラン一覧</h1>
@stop

@section('content')

<a href="">編集</a>
<a href="">削除</a>

<div class="myPlan">
    <div class="myPlan-header">
        <div class="myPlan-title">{{ $goal->content }}</div>
        <div class="myPlan-date">{{ $goal->date }}</div>
    </div>
    @for($i = 0; $i < count($goal->places); $i++)
        <div class="myPlan-body">
            <div class="myPlan-place">{{ $goal->places[$i]->content }}</div>
            <div class="myPlan-time ml-5">{{ $goal->times[$i]->time }}</div>
        </div>
    @endfor
</div>

@stop

@section('css')
<style>
    .myPlan-body {
        display: flex;
    }

</style>
@stop