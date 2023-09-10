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
                <div class="list-group-item list-group-item-action justify-content-end align-items-center plan-sub">
                    <div class="money">
                        移動費：<input type="number" class="form-control" id="price[${count-2}]" name="price[${count-2}]" value="0">円
                    </div>
                    <div class="transportation">
                        移動手段：<select name="transportation[${count - 2}]" id="transportation[${count - 2}]">
                                <option value="車">車</option>
                                <option value="タクシー">タクシー</option>
                                <option value="電車">電車</option>
                                <option value="新幹線">新幹線</option>
                                <option value="徒歩">徒歩</option>
                                <option value="その他">その他</option>
                            </select>
                    </div>
                </div>
                <div class="list-group-item list-group-item-action align-items-center plan-start">
                    <div class="plan-start-main-session">
                        <div class="text-center">
                            <input type="time" class="form-control time" id="time[${count*2 - 3}]" name="time[${count*2 - 3}]" placeholder="時間"">
                            <input type="time" class="form-control time" id="time[${count*2 - 2}]" name="time[${count*2 - 2}]" placeholder="時間"">
                        </div>
                        <div>
                            <input type="text" class="form-control place" id="place[${count - 1}]" name="place[${count - 1}]" placeholder="経由地">
                        </div>
                    </div>
                    <textarea class="w-100" name="memo[${count - 1}]" id="memo[${count - 1}]" placeholder="メモ"></textarea>
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


