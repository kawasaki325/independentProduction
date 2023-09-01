@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>みんなのプラン</h1>
@stop

@section('content')

<!-- 検索エリア・ -->
<form action="{{ route('search') }}" method="get">
    <div>
        @if(isset( $keyword ))
            <input type="text" name="keyword" value="{{ $keyword }}">
        @else
            <input type="text" placeholder="キーワード検索" name="keyword" >
        @endif
        <button type="submit">検索</button>
    </div>
    @error('keyword')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</form>

<a href="{{ route('share') }}">一覧表示</a>


<div class="myPlan">
    @if(!(count($goals) === 0))
        @foreach($goals as $goal)
            <a href="{{ route('share/detail/{plan}', ['plan' => $goal->id]) }}" class="myPlan-item">
                <div class="myPlan-header">
                    <div class="myPlan-title">{{ $goal->content }}</div>
                    <div class="myPlan-date">{{ $goal->date }}</div>
                    <div class="myPlan-date">{{ $goal->totalPrice }}</div>
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