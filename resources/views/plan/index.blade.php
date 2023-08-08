@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>プラン一覧</h1>
@stop

@section('content')

<a href="{{ route('create') }}">行先登録</a>

<div class="myPlan">
    @if(!(count($goals) === 0))
        @foreach($goals as $goal)
            <a href="{{ route('edit/{plan}', ['plan' => $goal->id]) }}" class="myPlan-item">
                <div class="myPlan-header">
                    <div class="myPlan-title">{{ $goal->content }}</div>
                    <div class="myPlan-date">{{ $goal->date }}</div>
                </div>
            </a>
        @endforeach
    @endif
</div>

@stop

@section('css')
<style>
    /* index.blade.phpのcss */
    .myPlane {
    
    }
    
    .myPlan-item {
        display: inline-block;
        background: #fff;
        margin-left: 10px;
    }
    
    .myPlan-header {
        color: #333;
    }
    
    .myPlan-title {
    
    }
    
    .myPlan-date {

    }
</style>
@stop