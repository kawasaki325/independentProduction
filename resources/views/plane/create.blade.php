<form action="{{ route('planes/create') }}" method="post">
    @csrf
    <div>
        <div>
            <label for="goal">プランの名前</label>
            <input type="text" class="form-control" id="goal" name="goal" placeholder="プランの名前">
            <input type="date" class="form-control" id="date" name="date">

        </div>

        <div>
            <label for="price">金額</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="経由地">
        </div>

        <div>
            <label for="place">経由地</label>
            <input type="text" class="form-control" id="place" name="place" placeholder="経由地">
        </div>

        <div>
            <label for="time">時間</label>
            <input type="time" class="form-control" id="time" name="time" placeholder="時間">
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-primary">登録</button>
    </div>
</form>
