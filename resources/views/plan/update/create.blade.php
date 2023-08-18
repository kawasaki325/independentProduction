@extends('adminlte::page')

@section('title', '行先登録')


@section('content')

<!-- <button class="btn btn-primary js-addPlace">行先を追加</button>
<button class="btn btn-primary js-deletePlace">行先を削除</button> -->
@if (count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('update/put') }}" method="post">
    @method('PUT')
    @csrf
    <div id="js-plan" data-plan-id="{{ count($goal->places) - 1 }}">
        <input type="hidden" name="goal_id" value="{{$goal->id}}">
        <div >
            <label for="goal">プランの名前</label>
            <input type="text" class="form-control" id="goal" name="goal" placeholder="プランの名前" value="{{ $goal->content }}">
            <input type="date" class="form-control" id="date" name="date" value="{{ $goal->date }}">
        </div>

        @for($i = 0; $i < count($goal->places); $i++)
            <div id="js-plan-{{$i}}">
                <label for="place">経由地</label>
                <input type="text" class="form-control" id="place" name="place[{{$i}}]" placeholder="経由地" value="{{ $goal->places[$i]->content }}">
                <label for="time">時間</label>
                <input type="time" class="form-control" id="time" name="time[{{$i}}]" placeholder="時間" value="{{ $goal->times[$i]->time }}">
                @if($i != count($goal->places) - 1)
                    <label for="place">金額</label>
                    <input type="number" class="form-control" id="price" name="price[{{$i}}]" value="{{ $goal->prices[$i]->amount }}">
                @endif
                <label for="memo">メモ</label>
                <textarea name="memo[{{ $i }}]" id="memo" placeholder="メモ">{{$goal->places[$i]->memo->content}}</textarea>
            </div>
        @endfor
    </div>

    <div>
        <button type="submit" class="btn btn-primary">編集する</button>
    </div>
</form>
    

@stop


@section('css')

@stop