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

<form action="{{ route('status/put/{plan}', ['plan' => $goal->id]) }}" method="post">
    @method('PUT')
    @csrf
    @if($goal->status === 'normal')
    <button type="submit" onclick='return confirm("本当に投稿しますか？")'>投稿する</button>
    @else
    <button type="submit" onclick='return confirm("本当に投稿を削除しますか？")'>投稿を削除する</button>
    @endif
</form>



@if(session('feedback.success'))
    <p style="color: green;">{{ session('feedback.success') }}</p>
@endif


<div class="myPlan-header">
    <div class="myPlan-title">{{ $goal->content }}</div>
    <div class="myPlan-date">{{ $goal->date }}</div>
</div>

<div class="list-group">
    @for($i = 0; $i < count($goal->places); $i++)
        <div class="list-group-item list-group-item-action">
            @if($i===0)
            <div class="myPlan-time ml-3">{{ $goal->times[$i]->time }}</div>
            @elseif($i == count($goal->places)-1)
            <div class="myPlan-time ml-3">{{ $goal->times[$i*2-1]->time }}</div>
            @else
            <div class="myPlan-time ml-3">{{ $goal->times[$i*2-1]->time }}</div>
            <div class="myPlan-time ml-3">{{ $goal->times[$i*2]->time }}</div>
            @endif
            <div class="myPlan-place ml-5">{{ $goal->places[$i]->content }}</div>
        </div>
        <div>

            {!! nl2br(e($goal->places[$i]->memo->content)) !!}
            <br>
            @if($i != count($goal->places) - 1)
                {{ $goal->prices[$i]->amount }}
            @endif
        </div>
    @endfor
</div>


@if (count($errors) > 0)
    @foreach ($errors as $error)
        {{ $error[0] }}
        <br>
    @endforeach
@endif

@stop

@section('css')
<style>
</style>
@stop