@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>プラン一覧</h1>
@stop

@section('content')

<a href="{{ route('planes/create') }}">行先登録</a>

@if(!(count($goals) === 0))
    @foreach($goals as $goal)
        <br>
        {{ $goal->content }}
        <br>
        {{ $goal->date }}
        <br>
        @for($i = 0; $i < count($goal->places); $i++)
            {{ $goal->places[$i]->content }}
            <br>
            {{ $goal->times[$i]->time }}
            <br>
        @endfor
        <div>--------------------------------------------------------</div>
    @endforeach
@endif



@stop