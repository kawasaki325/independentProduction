@extends('adminlte::page')

@section('title', '商品登録')

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
            @if($i !== count($goal->places)-1)
                <button type="button" class="btn btn-outline-secondary js-detail ml-auto">移動詳細</button>
            @endif
        </div>
        @if($i != count($goal->places) - 1)
            <div class="js-content" style="display: none;">
                <div class="list-group-item list-group-item-action d-flex align-items-center">

                        <div class="d-flex">
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
    
                    <div class="ml-5 d-flex">
                        <div><i class="fas fa-coins"></i></div>
                        <div class="ml-3">{{ $goal->prices[$i]->amount }}円</div>
                    </div>

                </div>
                
            </div>
        @endif
    @endfor

</div>
<div class="list-group-item list-group-item-action d-flex align-items-center">
    <div  class="ml-auto" style="font-size: 20px;">
        移動費合計：{{ $goal->totalPrice }} 円
    </div>
</div>

<div class="d-flex mt-3 align-items-center">
    <button class="btn btn-primary ml-2" onClick="history.back();">戻る</button>

    @if(!($goal->user->id === $user->id))
        <div class="d-flex ml-5 align-items-center">
            <div class="like js-like" data-user-id="{{ $goal->user->id }}" data-goal-id="{{ $goal->id }}" data-like-id="{{ $goal->like_id }}">
                @if(isset(  $goal->like_id  ))
                    <!-- いいね！している場合 -->
                    <div class="like"><i class="fas fa-thumbs-up" style="color: #007bff;"></i></div>
                @else
                    <!-- いいね！していない場合 -->
                    <div class="like is-opacity"><i class="fas fa-thumbs-up" style="color: #007bff;" ></i></div>
                @endif
            </div>
            <div class="like-count js-like-count ml-1">{{ count($goal->likedByUsers) }}</div>
        </div>
    @endif
</div>


@stop

@section('js')
<script src="{{ asset('js/like.js') }}"></script>
<script src="{{ asset('js/slide.js') }}"></script>
@stop

@section('css')
<style>
    .js-like {
        font-size: 20px;
    }

    .is-opacity {
        opacity: .3;
    }

    .js-like {
        cursor: pointer;
    }

</style>
@stop