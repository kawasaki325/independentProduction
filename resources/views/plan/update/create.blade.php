@extends('adminlte::page')

@section('title', '行先登録')


@section('content')

@php
$message = null;
@endphp

@if (count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            @if($error != $message)
                <li>{{ $error }}</li>
            @endif
            @php
            $message = $error;
            @endphp
        @endforeach
    </ul>
@endif

<form action="{{ route('update/put') }}" method="post">
    @method('PUT')
    @csrf
    <div id="js-plan" data-plan-id="{{ count($goal->places) - 1 }}">
        <input type="hidden" name="goal_id" value="{{$goal->id}}">
        <div class="plan-main p-3 bg-white align-items-center">
            <input type="text" class="form-control" id="goal" name="goal" placeholder="プランの名前" value="{{ $goal->content }}">
            <input type="date" class="form-control date" id="date" name="date" value="{{ $goal->date }}">
        </div>

        @for($i = 0; $i < count($goal->places); $i++)
        <div class="plan-start list-group-item list-group-item-action align-items-center">
            <div class="plan-start-main">
                @if($i===0)
                    <div>
                        <input type="time" class="form-control time" id="time" name="time[{{$i}}]" placeholder="時間" value="{{ $goal->times[$i]->time }}">
                    </div>
                @elseif($i == count($goal->places)-1)
                    <div>
                        <input type="time" class="form-control time" id="time" name="time[{{$i*2-1}}]" placeholder="時間" value="{{ $goal->times[$i*2-1]->time }}">
                    </div>
                @else
                    <div class="text-center">
                        <input type="time" class="form-control time" id="time[${i-2}]" name="time[{{$i*2-1}}]" placeholder="時間" value="{{$goal->times[$i*2-1]->time}}">
                        <input type="time" class="form-control time" id="time[${i-1}]" name="time[{{$i*2}}]" placeholder="時間" value="{{$goal->times[$i*2]->time}}">
                    </div>
                @endif
                <div>
                    <input type="text" class="form-control place" id="place[$i]" name="place[{{$i}}] " placeholder="経由地" value="{{ $goal->places[$i]->content }}">
                </div>
            </div>
            <textarea class="memo" name="memo[{{$i}}]" id="memoNext" placeholder="メモ">{{$goal->places[$i]->memo->content}}</textarea>



        </div>
        @if($i != count($goal->places) - 1)
            <div class="list-group-item list-group-item-action justify-content-end align-items-center plan-sub">
                <div class="money">
                    移動費：<input type="number" class="form-control" id="price" name="price[{{$i}}]" value="{{ $goal->prices[$i]->amount }}">円
                </div>
                <div class="transportation">
                    移動手段：
                            <select name="transportation[{{$i}}]" id="transportation[{{$i}}]">
                                <option value="車" <?php echo $goal->prices[$i]->transportation->transportation === '車' ? 'selected' : ''?>>車</option>
                                <option value="タクシー" <?php echo $goal->prices[$i]->transportation->transportation === 'タクシー' ? 'selected' : ''?>>タクシー</option>
                                <option value="タクシー" <?php echo $goal->prices[$i]->transportation->transportation === '飛行機' ? 'selected' : ''?>>飛行機</option>
                                <option value="電車" <?php echo $goal->prices[$i]->transportation->transportation === '電車' ? 'selected' : ''?>>電車</option>
                                <option value="新幹線" <?php echo $goal->prices[$i]->transportation->transportation === '新幹線' ? 'selected' : ''?>>新幹線</option>
                                <option value="徒歩" <?php echo $goal->prices[$i]->transportation->transportation === '徒歩' ? 'selected' : ''?>>徒歩</option>
                                <option value="その他" <?php echo $goal->prices[$i]->transportation->transportation === 'その他' ? 'selected' : ''?>>その他</option>
                            </select>
                </div>

            </div>
        @endif

        @endfor
    </div>

    <div>
        <button type="submit" class="btn btn-primary">編集する</button>
    </div>
</form>
    

@stop


@section('css')
<style>
    .plan-main {
        display: flex;
    }

    .date {
        width: 25%;
    }

    .plan-start {
        display: flex;
    }

    .plan-start-main {
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
        .plan-main {
        display: block;
        }

        .date {
            width: 150px;
        }

        .plan-start {
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