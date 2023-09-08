@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')

@stop

@section('content')


@if(session('feedback.success'))
    <p style="color: green;">{{ session('feedback.success') }}</p>
@endif

<form action="{{ route('/home') }}" method="get">
    <!-- 検索エリア・ -->
    <div class="d-flex align-items-center mb-2 pt-3">
            <select type="text" class="form-control w-25 mr-2" name="area">
                    <option value="未選択">現在の天気を検索できます</option>
                @foreach(config('prefectures') as $key => $prefecture)
                    <option value="{{ $key }}">{{ $prefecture }}</option>
                @endforeach
            </select>
            <button type="submit">検索</button>
    </div>
</form>

@if($temp != null)
    {{config('prefectures')[ $area ]}}の今の天気
    <img src="{{$img}}" alt="天気の画像">
    {{$temp}}度
@endif

<div class="mt-4">
    @if(!(count($goals) === 0))
    <div class="container">
        <div class="row row-md-1">
            @foreach($goals as $goal)
            <div class="col-md-4 col-sm-6 mb-4">
                <a href="{{ route('update/{plan}', ['plan' => $goal->id]) }}" class="text-dark">
                    <div class="card mx-auto" style="width: 14rem;">
                        <img src="{{ asset('img/test.jpg') }}" class="card-img-top" alt="...">
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
    <div class="d-flex justify-content-center">
        {{ $goals->links() }}
    </div>

    @else
        <p>作成したプランがありません</p>
    @endif
</div>

@stop

@section('css')
<style>

</style>
@stop