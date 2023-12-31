@extends('adminlte::page')

@section('title', '旅行プラン修正')

@section('content_header')

@stop

@section('content')


@if(session('feedback.success'))
    <p style="color: green;">{{ session('feedback.success') }}</p>
@endif

<div class="d-flex p-3 bg-white align-items-center">
    <h2 class="mb-0 ml-3">{{ $goal->content }}</h2>
    <h4 class="ml-5 mb-0">{{ $goal->date }}</h4>
</div>


<div class="list-group">
    @for($i = 0; $i < count($goal->places); $i++)
        <div class="list-group-item list-group-item-action d-flex align-items-center">
            @if($i===0)
            <div class="ml-3">{{ substr($goal->times[$i]->time, 0, 5) }}</div>
            @elseif($i == count($goal->places)-1)
            <div class="ml-3">{{ substr($goal->times[$i*2-1]->time, 0, 5) }}</div>
            @else
                @if( $goal->times[$i*2-1]->time !== $goal->times[$i*2]->time )
                    <div class="text-center">
                        <div class="ml-3">{{substr($goal->times[$i*2-1]->time, 0, 5) }}</div>
                        <div class="ml-3">|</div>
                        <div class="ml-3">{{ substr($goal->times[$i*2]->time, 0, 5) }}</div>
                    </div>
                @else
                    <div class="text-center">
                        <div class="ml-3">{{substr($goal->times[$i*2-1]->time, 0, 5) }}</div>
                    </div>
                @endif
            @endif
            <div class="myPlan-place ml-5">{{ $goal->places[$i]->content }}</div>

            @if($i != count($goal->places)-1 || $goal->places[$i]->memo->content !== null)
                <button type="button" class="btn btn-outline-secondary js-detail ml-auto">移動詳細</button>
            @endif

        </div>
        @if($i != count($goal->places) - 1)
            <div class="js-content" style="display: none;">
                <div class="list-group-item list-group-item-action">
                    <div class=" group-list">
                        <div class="d-flex align-items-center">
                            <div class="ml-3">
                                @if($goal->prices[$i]->transportation->transportation === '車')
                                    <i class="fas fa-car"></i>
                                @elseif($goal->prices[$i]->transportation->transportation === 'タクシー')
                                    <i class="fas fa-taxi"></i>
                                @elseif($goal->prices[$i]->transportation->transportation === '飛行機')
                                    <i class="fas fa-plane"></i>
                                @elseif($goal->prices[$i]->transportation->transportation === '電車')
                                    <i class="fas fa-train"></i>
                                @elseif($goal->prices[$i]->transportation->transportation === '徒歩')
                                    <i class="fas fa-walking"></i>
                                @elseif($goal->prices[$i]->transportation->transportation === 'その他')
                                    <i class="fas fa-otter"></i>
                                @elseif($goal->prices[$i]->transportation->transportation === '新幹線')
                                    <div><img src="{{ asset('img/train.svg') }}" alt="" style = "width: 14px;"></div>
                                @else
                                    <div>移動時間：</div>
                                @endif
                            </div>
                            <div class="ml-3">
                                @if($i !== 0)
                                    @php
                                        $timeDifference = $goal->times[$i*2 + 1]->formattedTime->diffInSeconds($goal->times[$i*2]->formattedTime);
                                        $hours = floor($timeDifference / 3600);
                                        $minutes = floor(($timeDifference - ($hours * 3600)) / 60);
                                    @endphp
    
                                @else
                                    @php
                                        $timeDifference = $goal->times[1]->formattedTime->diffInSeconds($goal->times[0]->formattedTime);
                                        $hours = floor($timeDifference / 3600);
                                        $minutes = floor(($timeDifference - ($hours * 3600)) / 60);
                                    @endphp
                                @endif
                                    @if ($hours > 0)
                                        {{ $hours }} 時間
                                    @endif
    
                                    @if ($minutes > 0)
                                        {{ $minutes }} 分
                                    @endif
                            </div>
                        </div>
                        <div class="d-flex align-items-center money">
                            <div><i class="fas fa-coins ml-3"></i></div>
                            <div class="ml-3">{{ $goal->prices[$i]->amount }}円</div>
                        </div>
                        @if( $goal->places[$i]->memo->content !== null)
                            <div class="row memo ml-2">
                                <div class="col-md-2 col-2">メモ</div>
                                <div class="border col-md-8 col-10">
                                    <div class="w-100 text-break">
                                        {!! nl2br(e($goal->places[$i]->memo->content)) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            @if( $goal->places[$i]->memo->content !== null)
                <div class="js-content" style="display: none;">
                    <div class="list-group-item list-group-item-action last-memo align-items-center">
                        <div class="row ml-2">
                            <div class="col-md-2 col-2">メモ</div>
                            <div class="border col-md-8 col-10">
                                <div class="w-100 text-break">
                                    {!! nl2br(e($goal->places[$i]->memo->content)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endfor
</div>

<div class="list-group-item list-group-item-action d-flex align-items-center">
    <div  class="ml-auto" style="font-size: 20px;">
        移動費合計：{{ $goal->totalPrice }} 円
    </div>
</div>

<div class="d-flex mt-3">
    <button class="btn btn-primary ml-2"><a href="{{ route('/home') }}" class="text-decoration-none text-white">戻る</a></button>
    <button class="btn btn-primary ml-2"><a href="{{ route('update/create/{plan}', ['plan' => $goal->id]) }}" class="text-decoration-none text-white">編集</a></button>
    <form action="{{ route('update/delete/{plan}', ['plan' => $goal->id]) }}" method="post" class="mb-0">
        @method('DELETE')
        @csrf
        <button class="btn btn-primary ml-2" type="submit" onclick='return confirm("本当に削除しますか？")'>削除</button>
    </form>
    <form action="{{ route('status/put/{plan}', ['plan' => $goal->id]) }}" method="post" class="mb-0">
        @method('PUT')
        @csrf
        @if($goal->status === 'normal')
        <button class="btn btn-primary ml-2" type="submit" onclick='return confirm("本当に投稿しますか？")'>投稿する</button>
        @else
        <button class="btn btn-primary ml-2" type="submit" onclick='return confirm("本当に投稿を削除しますか？")'>投稿を削除する</button>
        @endif
    </form>
</div>



@if (count($errors) > 0)
    @foreach ($errors as $error)
        {{ $error[0] }}
        <br>
    @endforeach
@endif

@stop

@section('js')
<script src="{{ asset('js/slide.js') }}"></script>
@stop

@section('css')
<style>
    .group-list {
        display: flex;
        align-items: center;
    }

    .money {
        margin-left: 3rem;
    }

    .memo {
        margin-left: 3rem;
        width: 50%;
    }

    .last-memo {
        display: flex;
    }


    @media screen and (max-width: 767px) {
    .group-list {
        display: block;
    }

    .money {
        margin: 5px 0px;
    }

    .memo {
        margin: 5px 0px;
        width:100%
    }
}
</style>