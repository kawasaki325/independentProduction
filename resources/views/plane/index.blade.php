@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>プラン一覧</h1>
@stop

@section('content')

<a href="{{ route('planes/create') }}">行先登録</a>
<br>
{{ $goal[0]->content }}
<br>
{{ $goal[0]->date }}
<br>
{{ $goal[0]->prices[0]->amount }}
<br>
{{ $goal[0]->places[0]->content }}
<br>
{{ $goal[0]->times[0]->time }}




@stop