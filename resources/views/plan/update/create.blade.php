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
        <div class="d-flex p-3 bg-white align-items-center">
            <input type="text" class="form-control" id="goal" name="goal" placeholder="プランの名前" value="{{ $goal->content }}">
            <input type="date" class="form-control w-25" id="date" name="date" value="{{ $goal->date }}">
        </div>

        @for($i = 0; $i < count($goal->places); $i++)
        <div class="list-group-item list-group-item-action d-flex align-items-center">
            @if($i===0)
                <div>
                    <input type="time" class="form-control" id="time" name="time[{{$i}}]" placeholder="時間" value="{{ $goal->times[$i]->time }}">
                </div>
            @elseif($i == count($goal->places)-1)
                <div>
                    <input type="time" class="form-control" id="time" name="time[{{$i*2-1}}]" placeholder="時間" value="{{ $goal->times[$i*2-1]->time }}">
                </div>
            @else
                <div class="text-center">
                    <input type="time" class="form-control" id="time[${i-2}]" name="time[{{$i*2-1}}]" placeholder="時間" value="{{$goal->times[$i*2-1]->time}}">
                    <input type="time" class="form-control" id="time[${i-1}]" name="time[{{$i*2}}]" placeholder="時間" value="{{$goal->times[$i*2]->time}}">
                </div>
            @endif
            <div>
                <input type="text" class="form-control" id="place[$i]" name="place[{{$i}}] " placeholder="経由地" value="{{ $goal->places[$i]->content }}">
            </div>
            <textarea class="w-100" name="memo[{{$i}}]" id="memoNext" placeholder="メモ">{{$goal->places[$i]->memo->content}}</textarea>



        </div>
        @if($i != count($goal->places) - 1)
            <div class="list-group-item list-group-item-action d-flex justify-content-end align-items-center">
                <div>移動費：</div>
                <input type="number" class="form-control w-25" id="price" name="price[{{$i}}]" value="{{ $goal->prices[$i]->amount }}">
                <div class="mr-5">円</div>

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
        @endif

        @endfor
    </div>

    <div>
        <button type="submit" class="btn btn-primary">編集する</button>
    </div>
</form>
    

@stop


@section('css')

@stop