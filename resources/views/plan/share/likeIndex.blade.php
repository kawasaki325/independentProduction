@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    
@stop

@section('content')


<div>
    @if(!(count($goals) === 0))
    <div class="container">
        <div class="row row-md-1">
            @foreach($goals as $goal)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <a href="{{ route('like/detail/{plan}', ['plan' => $goal->id]) }}" class="text-dark">
                            <div class="card mx-auto" style="width: 14rem;">
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
    
    .myPlan-title {
    
    }
    
    .myPlan-date {

    }
</style>
@stop