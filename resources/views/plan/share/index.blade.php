@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    
@stop


@section('content')

<div class="pt-5">
    <form action="{{ route('search') }}" method="get">
        <!-- 検索エリア・ -->
        <div class="d-flex align-items-center mb-5">
            <div>
                @if(isset( $keyword ))
                    <input type="text" name="keyword" value="{{ $keyword }}">
                @else
                    <input type="text" placeholder="キーワード検索" name="keyword" >
                @endif
                <button type="submit">検索</button>
            </div>
            @error('keyword')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <div class="js-open-button ml-3 text-primary" data-target=".target-modal">絞り込み</div>
            <div class="ml-3">
                <a href="{{ route('share') }}">クリア</a>
            </div>
        </div>
    </form>

    <form action="{{ route('search') }}" method="get">
        <div class="modal-contact target-modal">
            <div class="mt-3 text-center font-weight-bold">絞り込み</div>
            <div class="text-center mt-4">
                @if(isset( $keyword ))
                    <input type="text" name="keyword" value="{{ $keyword }}">
                @else
                    <input type="text" placeholder="キーワード検索" name="keyword" >
                @endif
                <button type="submit">検索</button>
            </div>

            <div>
                <select type="text" class="form-control mt-4 w-50 mx-auto" name="area">
                        <option value="未選択">未選択</option>
                    @foreach(config('prefectures') as $key => $prefecture)
                        <option value="{{ $prefecture }}">{{ $prefecture }}</option>
                    @endforeach
                </select>

            </div>

            <div class="d-flex flex-wrap justify-content-center mt-4">
                <label class="contact-radio">
                    <input type="radio" name="price" class="radio-input" value="0" checked>
                    <span class="radio-part">指定なし</span>
                </label>
                <label class="contact-radio">
                    <input type="radio" name="price" class="radio-input" value="1500">
                    <span class="radio-part">0-1500円</span>
                </label>
                <label class="contact-radio">
                    <input type="radio" name="price" class="radio-input" value="5000">
                    <span class="radio-part">1501-5000円</span>
                </label>
                <label class="contact-radio">
                    <input type="radio" name="price" class="radio-input" value="10000">
                    <span class="radio-part">5001-10000円</span>
                </label>
                <label class="contact-radio">
                    <input type="radio" name="price" class="radio-input" value="10001">
                    <span class="radio-part">10001円以上</span>
                </label>
            </div>


            <div class="modal-contact__button text-center mt-5"><a class=" js-close-button" href="" data-target=".target-modal">閉じる</a></div>
        </div>
    </form>

</div>
<div class="modal-contact__background target-modal"></div>
    


<div class="myPlan">
    @if(!(count($goals) === 0))
    <div class="container">
        <div class="row row-md-1">
            @foreach($goals as $goal)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <a href="{{ route('share/detail/{plan}', ['plan' => $goal->id]) }}" class="text-dark">
                            <div class="card mx-auto" style="width: 14rem;">
                                <img src="{{ asset('storage/images/test.jpg') }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-text">{{ $goal->content }}</h5>
                                    <p class="card-text mb-1">移動費：{{ $goal->totalPrice }}円</p>
                                    <p class="card-text">{{ $goal->user->name }}さんの投稿</p>
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
    @endif
</div>

</div>


@stop

@section('css')
<style>
.js-open-button {
    cursor: pointer;
}

.modal-contact {
    position: fixed;
    z-index: 501;
    padding: 0 10px;
    width: 400px;
    max-width: calc(100% - 48px);
    height: 400px;
    max-height: calc(100% - 48px);
    background: #fff;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.16);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #707070;
    display: none;
}

.modal-contact__background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 500;
  display: none;
}

.contact-radio {
  position: relative;
  display: block;
  width: 30%;
  text-align: center;
}

.radio-input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
.radio-input:checked + .radio-part {
  background: #3EA1D1;
  color: #fff;
  border-radius: 1px;
}

.radio-part {
  display: block;
  background: #fff;
  color: #3EA1D1;
  height: 38px;
  line-height: 38px;
  width: 100%;
  text-align: center;
  border: 1px solid #707070;
  transition: background-color 0.4s, color 0.4s;
}

.radio-area {
    margin: 0 auto;
}
</style>
@stop

@section('js')
<script src="{{ asset('js/modal.js') }}"></script>
@stop