$(function() {
    $('.js-addPlace').click(function() {
        let count = $('#js-plan').attr('data-plan-id');
        count++;
        $('#js-plan').append(`<div id="js-plan-${count}">
        <div class="input-area">
            <div class="input-items">
                <div class="input-item">
                    <label for="place">経由地</label>
                    <input type="text" class="form-control" id="place" name="place[${count}]" placeholder="経由地">
                </div>
                <div class="input-item">
                    <label for="time">時間</label>
                    <input type="time" class="form-control" id="time" name="time[${count}]" placeholder="時間"">
                </div>
                <div class="input-item">
                    <label for="price">金額</label>
                    <input type="number" class="form-control" id="price" name="price[${count - 1}]" value="0">
                </div>
                <div class="input-item">
                    <label for="memo">メモ</label><textarea name="memo[${count}]" id="memo" placeholder="メモ"></textarea>
                </div>
            </div>
        </div>
        </div>`);
        $('#js-plan').attr('data-plan-id', count);
    });

    $('.js-deletePlace').click(function() {
        let countDelete = $('#js-plan').attr('data-plan-id');
        if(countDelete > 0) {
            $(`#js-plan-${countDelete}`).remove();
            countDelete--;
            $('#js-plan').attr('data-plan-id', countDelete);
        }
    });
});


