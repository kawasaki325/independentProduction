@extends('adminlte::page')

@section('title', '行先登録')


@section('content')

<button class="btn btn-primary js-addPlace">行先を追加</button>

<button class="btn btn-primary js-deletePlace">行先を削除</button>

<form action="{{ route('store') }}" method="post">
    @csrf
    <div id="js-plan" data-plan-id="0">
            <div >
                <label for="goal">プランの名前</label>
                <input type="text" class="form-control" id="goal" name="goal" placeholder="プランの名前" value="{{ old('goal') }}">
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
            </div>
            <div>
                <!-- <label for="price">金額</label>
                <input type="number" class="form-control" id="price" name="price[0]" placeholder="金額を入力" value="{{ old('price.0') }}"> -->
                <label for="place">経由地</label>
                <input type="text" class="form-control" id="place" name="place[0]" placeholder="経由地">
                <label for="time">時間</label>
                <input type="time" class="form-control" id="time" name="time[0]" placeholder="時間">
                <label for="memo">メモ</label>
                <textarea name="memo[0]" id="memo" placeholder="メモ"></textarea>
            </div>

        </div>

        <div>
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
    </form>
    
    @if (count($errors) > 0)
        @foreach ($errors as $error)
            {{ $error[0] }}
            <br>
        @endforeach
    @endif
@stop

@section('js')
<script>
    $(function() {
        @if (count($errors) > 0)
            // コントローラーから送ったjsonデータを取得
            var goal = @json($goal);
            var date = @json($date);
            var place = @json($place);
            var memo = @json($memo);
            var time = @json($time);
            // 取得したデータをセッションに保存
            sessionStorage.setItem('goal', goal);
            sessionStorage.setItem('date', date);
            sessionStorage.setItem('place', place);
            sessionStorage.setItem('memo', memo);
            sessionStorage.setItem('time', time);
        @endif
        console.log(memo);
    })
</script>
<script src="{{ asset('js/addPlace.js') }}"></script>
<script src="{{ asset('js/session.js') }}"></script>
@stop

@section('css')

@stop