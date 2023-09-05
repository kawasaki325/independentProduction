@extends('adminlte::page')

@section('title', '行先登録')


@section('content')
<div class="my-3">
    <button class="btn btn-primary js-addPlace">経由地を追加</button>
    
    <button class="btn btn-primary js-deletePlace">追加した経由地を削除</button>
</div>

@if (count($errors) > 0)
    @foreach ($errors as $error)
        {{ $error[0] }}
        <br>
    @endforeach
@endif

<form  class="create-form" action="{{ route('store') }}" method="post">
@csrf
    <div id="js-plan" data-plan-id="1">
        <div>
            <div class="d-flex p-3 bg-white align-items-center">
                <input type="text" class="form-control" id="goal" name="goal" placeholder="プランの名前" value="{{ old('goal') }}" autofocus>
                <input type="date" class="form-control w-25" id="date" name="date" value="{{ old('date') }}">
            </div>

            <div class="list-group-item list-group-item-action d-flex align-items-center">
                <div>
                    <input type="time" class="form-control" id="time" name="time[0]" placeholder="時間">
                </div>
                <div>
                    <input type="text" class="form-control" id="place" name="place[0]" placeholder="出発">
                </div>
                <textarea class="w-100" name="memo[0]" id="memo" placeholder="メモ"></textarea>
            </div>
        </div>

        <div class="add-point">
            <div class="list-group-item list-group-item-action d-flex justify-content-end align-items-center">
                <div>移動費：</div>
                <input type="number" class="form-control w-25" id="price" name="price[0]" value="0">
                <div class="mr-5">円</div>

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
    
            <div class="list-group-item list-group-item-action d-flex align-items-center">
                <div>
                    <input type="time" class="form-control" id="timeNext" name="time[1]" placeholder="時間">
                </div>
                <div>
                    <input type="text" class="form-control" id="placeNext" name="place[1]" placeholder="目的地">
                </div>
                <textarea class="w-100" name="memo[1]" id="memoNext" placeholder="メモ"></textarea>
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


    .input-items {
        display: flex;
    }

</style>
@stop



