@extends('adminlte::page')

@section('title', 'ホーム')

@section('content_header')
    <h1>ホーム</h1>
@stop

@section('content')


@if(session('feedback.success'))
    <p style="color: green;">{{ session('feedback.success') }}</p>
@endif

<form action="{{ route('/home') }}" method="get">
    <!-- 検索エリア・ -->
    <div class="mb-2 pt-3 row align-items-center justify-content-start">
        <div class="pr-2">
            <select type="text" class="form-control" name="area">
                    <option value="未選択">現在の天気を検索できます</option>
                @foreach(config('prefectures') as $key => $prefecture)
                    <option value="{{ $key }}">{{ $prefecture }}</option>
                @endforeach
            </select>
        </div>
        <div class="">
            <button type="submit">検索</button>
        </div>
    </div>
</form>


@if($temp != null)
    <div class="answer">
        {{config('prefectures')[ $area ]}}の今の天気
        <img src="{{$img}}" alt="天気の画像">
        {{$temp}}度
    </div>
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
                            <p class="card-text mb-1">移動費：{{ $goal->totalPrice }}円</p>
                            @if($goal->status == 'active')
                                <p class="text-center mb-0 text-primary">投稿中</p>
                            @endif
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

    @else
        <p>作成したプランがありません</p>
    @endif
</div>

@stop

@section('css')
<style>
    @media screen and (max-width: 767px) {
  .answer {
    text-align: center;
  }
}

</style>
@stop