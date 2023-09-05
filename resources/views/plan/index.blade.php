@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')

@stop

@section('content')


@if(session('feedback.success'))
    <p style="color: green;">{{ session('feedback.success') }}</p>
@endif

<div>
    @if(!(count($goals) === 0))
    <div class="container">
        <div class="row row-md-1 row-.col-xl-2 row-cols-xxl-3">
            @foreach($goals as $goal)
                    <div class="col mb-4">
                        <a href="{{ route('update/{plan}', ['plan' => $goal->id]) }}" class="text-dark">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('storage/images/test.jpg') }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-text">{{ $goal->content }}</h5>
                                    <p class="card-text mb-1">{{ $goal->date }}</p>
                                    <p class="card-text">移動費：{{ $goal->totalPrice }}円</p>
                                </div>
                            </div>
                        </a>
                        @if($goal->status == 'active')
                        <p>投稿済み</p>
                        @endif
                    </div>
            @endforeach
        </div>
    </div>
    @else
        <p>作成したプランがありません</p>
    @endif
</div>

@stop

@section('css')
@stop