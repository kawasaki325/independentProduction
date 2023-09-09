@extends('adminlte::page')

@section('title', '投稿一覧')

@section('content_header')
    <h1>{{$goals[0]->user->name}}さんの投稿一覧</h1>
@stop


@section('content')

<div class="mt-3">
    <button class="btn btn-primary btn-sm btn-reverse mb-3"><a href="{{ route('individual/{user_id}', ['user_id' => $goals[0]->user->id]) }}" class="text-white">戻る</a></button>
</div>

<div class="myPlan">
    @if(!(count($goals) === 0))
    <div class="container">
        <div class="row row-md-1">
            @foreach($goals as $goal)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card mx-auto" style="width: 14rem;">
                            <a href="{{ route('share/detail/{plan}', ['plan' => $goal->id]) }}" class="text-dark">
                                <img src="{{ asset('img/test.jpg') }}" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body text-center">
                                <h5 class="card-text">{{ $goal->content }}</h5>
                                <p class="card-text mb-1">移動費：{{ $goal->totalPrice }}円</p>
                                <p class="card-text">
                                    @if(Auth::id() !== $goal->user->id)
                                        <a href="{{ route('individual/{user_id}', ['user_id' => $goal->user->id]) }}">{{ $goal->user->name }}さん</a>の投稿
                                    @else
                                        {{ $goal->user->name }}さんの投稿
                                    @endif
                                </p>
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

@section('css')
<style>

</style>
@stop

@section('js')

@stop