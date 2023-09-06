@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    
@stop

@section('content')
<div class="pt-5">
    <!-- 検索エリア・ -->
    <div class="d-flex align-items-center mb-5">
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
        <div class="ml-3">
            <a href="{{ route('share') }}">クリア</a>
        </div>
    </div>
    
    <div class="myPlan">
        @if(!(count($goals) === 0))
        <div class="container">
            <div class="row row-md-1 row-.col-xl-2 row-cols-xxl-3">
                @foreach($goals as $goal)
                        <div class="col mb-4">
                            <a href="{{ route('share/detail/{plan}', ['plan' => $goal->id]) }}" class="text-dark">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ asset('storage/images/test.jpg') }}" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <h5 class="card-text">{{ $goal->content }}</h5>
                                        <p class="card-text mb-1">移動費：{{ $goal->totalPrice }}円</p>
                                        <p class="card-text">{{ $goal->user->name }}さんの投稿</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

</div>


@stop

@section('css')
<style>

</style>
@stop