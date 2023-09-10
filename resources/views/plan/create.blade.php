@extends('adminlte::page')

@section('title', '旅行プランを作る')

@section('content_header')
    <h1>旅行プランを作る</h1>
@stop


@section('content')
<div class="my-3">
    <button class="btn btn-primary js-addPlace">経由地を追加</button>
    
    <button class="btn btn-primary js-deletePlace">追加した経由地を削除</button>
</div>


@php
$message = null;
@endphp

@if (count($errors) > 0)
<ul>
    @foreach ($errors as $error)
    @if($error[0] != $message)
            <li>{{ $error[0] }}</li>
        @endif
        @php
        $message = $error[0];
        @endphp
    @endforeach
</ul>
@endif


<form  class="create-form" action="{{ route('store') }}" method="post">
@csrf
    <div id="js-plan" data-plan-id="1">
        <div>
            <div class="plan-title p-3 bg-white align-items-center">
                <input type="text" class="form-control" id="goal" name="goal" placeholder="プランの名前" value="{{ old('goal') }}" autofocus>
                <select type="text" class="form-control area" name="area">
                        <option value="">出発地する県名</option>
                    @foreach(config('prefectures') as $key => $prefecture)
                        <option value="{{ $prefecture }}">{{ $prefecture }}</option>
                    @endforeach
                </select>
                <input type="date" class="form-control date" id="date" name="date" value="{{ old('date') }}">
            </div>

            <div class="list-group-item list-group-item-action align-items-center">
                <div class="plan-start-main">
                    <div>
                        <input type="time" class="form-control time" id="time" name="time[0]" placeholder="時間">
                    </div>
                    <div>
                        <input type="text" class="form-control place" id="place" name="place[0]" placeholder="出発">
                    </div>
                    <textarea class="memo" name="memo[0]" id="memo" placeholder="メモ"></textarea>
                </div>
            </div>
        </div>

        <div class="add-point">
            <div class="list-group-item list-group-item-action justify-content-end align-items-center plan-sub">
                <div class="money">
                    移動費：<input type="number" class="form-control" id="price" name="price[0]" value="0">円
                </div>

                <div class="transportation">
                    移動手段：
                    <select name="transportation[0]" id="transportation">
                        <option value="車">車</option>
                        <option value="タクシー">タクシー</option>
                        <option value="電車">電車</option>
                        <option value="新幹線">新幹線</option>
                        <option value="徒歩">徒歩</option>
                        <option value="その他">その他</option>
                    </select>
                </div>
            </div>
    
            <div class="plan-start-main list-group-item list-group-item-action align-items-center">
                <div>
                    <input type="time" class="form-control time" id="timeNext" name="time[1]" placeholder="時間">
                </div>
                <div>
                    <input type="text" class="form-control place" id="placeNext" name="place[1]" placeholder="目的地">
                </div>
                <textarea class="memo" name="memo[1]" id="memoNext" placeholder="メモ"></textarea>
            </div>
        </div>

    </div>

    <div>
        <button type="submit" class="btn btn-primary">登録</button>
    </div>
</form>


@stop

@section('js')
<script>
    $(function() {
        @if (count($errors) > 0)
            // コントローラーから送ったjsonデータを取得
            var goal = @json($goal);
            var date = @json($date);
            var place = @json($place);
            var price = @json($price);
            var transportation = @json($transportation);
            var memo = @json($memo);
            var time = @json($time);
            // 取得したデータをセッションに保存
            sessionStorage.setItem('goal', goal);
            sessionStorage.setItem('date', date);
            sessionStorage.setItem('place', place);
            sessionStorage.setItem('transportation', transportation);
            sessionStorage.setItem('price', price);
            sessionStorage.setItem('memo', memo);
            sessionStorage.setItem('time', time);
        @endif
    })
</script>
<script src="{{ asset('js/addPlace.js') }}"></script>
<script src="{{ asset('js/session.js') }}"></script>
@stop

@section('css')
<style>
    .plan-title {
        display: flex;
    }

    .area {
        width: 25%;
    }
    
    .date {
        width: 25%;
    }

    .plan-start {
        display: flex;
    }

    .plan-main {
        display: flex;
    }

    .plan-start-main {
        display: flex;
        align-items: center;
    }

    .plan-start-main-session {
        display: flex;
        align-items: center;
    }

    .memo {
        width: 100%;
    }

    .plan-sub {
        display: flex;
    }

    .money {
        display: flex;
        align-items: center;
        justify-content: end;
        margin-right: 50px;
    }

    .money input {
        width: 25%;
    }
    
    @media screen and (max-width: 767px) {
        .plan-title {
            display: block;
        }
        .area {
            width: 170px
        }
        
        .date {
            width: 170px;
        }

        .plan-start {
            display: block;
        }

        .plan-main {
            display: block;
        }

        .date {
            width: 150px;
        }

        .plan-start-main {
            display: block;
        }
        

        .time {
        width: 100px;
        }
        
        .place {
            width: 150px;
        }

        .plan-sub {
            display: block;
        }

        .money {
            display: flex;
            align-items: center;
            justify-content: end;
            margin-right: 0px;
        }

        .transportation {
            text-align: right;
            margin-top: 20px;
        }

        .money input {
            width: 100px;
        }
    }

</style>
@stop



