@extends('adminlte::page')

@section('title', 'お気に入りの投稿')

@section('content_header')
    <h1>お気に入りの投稿</h1>
@stop

@section('content')


<div class="pt-4">
    @if(!(count($goals) === 0))
    <div class="container">
        <div class="row row-md-1">
            @foreach($goals as $goal)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card mx-auto" style="width: 14rem;">
                            <a href="{{ route('like/detail/{plan}', ['plan' => $goal->id]) }}" class="text-dark">
                                <img src="{{ asset('img/test.jpg') }}" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body text-center">
                                <h5 class="card-text">{{ $goal->content }}</h5>
                                <p class="card-text mb-1">移動費：{{ $goal->totalPrice }}円</p>
                                <a href="{{ route('individual/{user_id}', ['user_id' => $goal->user->id]) }}">{{ $goal->user->name }}さん</a>の投稿
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $goals->links() }}
    </div>
    @endif
</div>

@stop

@section('js')
<script src="{{ asset('js/like.js') }}"></script>
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
</style>
@stop