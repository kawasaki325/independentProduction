$(function() {
    $('.js-addPlace').click(function() {
        let place = $('.add-point input[type="text"]');
        let time = $('.add-point input[type="time"]');
        let price = $('.add-point input[type="number"]');
        let transportation = $('.add-point select');
        let memo = $('.add-point textarea');
        let count = $('#js-plan').attr('data-plan-id');
        count++;
        $('.add-point').before(`<div id="js-plan-${count - 1}">
        <div class="input-area">
            <div class="input-items">
                <div class="input-item">
                    <label for="place[${count - 1}]">経由地</label>
                    <input type="text" class="form-control" id="place[${count - 1}]" name="place[${count - 1}]" placeholder="経由地">
                </div>
                <div class="input-item">
                    <label for="time">時間</label>
                    <input type="time" class="form-control" id="time[${count*2 - 3}]" name="time[${count*2 - 3}]" placeholder="時間"">
                    <input type="time" class="form-control" id="time[${count*2 - 2}]" name="time[${count*2 - 2}]" placeholder="時間"">
                </div>
                <div class="input-item">
                    <label for="price[${count-2}]">金額</label>
                    <input type="number" class="form-control" id="price[${count-2}]" name="price[${count-2}]" value="0">
                </div>
                <div class="input-item">
                    <label for="transportation[${count - 2}]">移動手段</label>
                    <select name="transportation[${count - 2}]" id="transportation[${count - 2}]">
                        <option value="車">車</option>
                        <option value="タクシー">タクシー</option>
                        <option value="電車">電車</option>
                        <option value="新幹線">新幹線</option>
                        <option value="徒歩">徒歩</option>
                        <option value="その他">その他</option>
                    </select>
                </div>
                <div class="input-item">
                    <label for="memo[${count - 1}]">メモ</label>
                    <textarea name="memo[${count - 1}]" id="memo[${count - 1}]" placeholder="メモ"></textarea>
                </div>
            </div>
        </div>
        </div>`);
        place.attr('name', `place[${count}]`);
        time.attr('name', `time[${count * 2 - 1}]`);
        price.attr('name', `price[${count - 1}]`);
        transportation.attr('name', `transportation[${count - 1}]`);
        memo.attr('name', `memo[${count}]`);
        $('#js-plan').attr('data-plan-id', count);
    });

    $('.js-deletePlace').click(function() {
        let place = $('.add-point input[type="text"]');
        let time = $('.add-point input[type="time"]');
        let price = $('.add-point input[type="number"]');
        let transportation = $('.add-point select');
        let memo = $('.add-point textarea');

        let countDelete = $('#js-plan').attr('data-plan-id');

        if(countDelete > 1) {
            countDelete--;
            $(`#js-plan-${countDelete}`).remove();
            place.attr('name', `place[${countDelete}]`);
            time.attr('name', `time[${countDelete * 2 - 1}]`);
            price.attr('name', `price[${countDelete - 1}]`);
            transportation.attr('name', `transportation[${countDelete - 1}]`);
            memo.attr('name', `memo[${countDelete}]`);
            $('#js-plan').attr('data-plan-id', countDelete);
        }
    });
});


