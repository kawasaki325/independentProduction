$(function() {
    // 行先登録画面のロードがあったら
    $(document).ready(function() {
        // plan-id（経由地・時間・金額が何セット記入してあるか）を取得
        let count = $('#js-plan').attr('data-plan-id');
        // セッションからデータを取得
        var goal = sessionStorage.getItem('goal');
        var date = sessionStorage.getItem('date');
        var place = sessionStorage.getItem('place');
        var transportation = sessionStorage.getItem('transportation');
        var price = sessionStorage.getItem('price');
        var memo = sessionStorage.getItem('memo');
        var time = sessionStorage.getItem('time');
        // セッションから取得したデータを使えるようにする
        goal = JSON.parse(goal);
        date = JSON.parse(date);
        place = JSON.parse(place);
        transportation = JSON.parse(transportation);
        price = JSON.parse(price);
        memo = JSON.parse(memo);
        time = JSON.parse(time);

        if(place !== null) {
            // データの数を取得
            var arrayCount = place.length;
        } else {
            return;
        }
        // もしセッションから取得したデータがあれば
        if(arrayCount > 0) {
            // 行先登録画面に最初からある登録覧に値を入力
            $('#goal').attr({
                'value': goal,
            });
            $('#date').attr({
                'value': date,
            });
            $('#place').attr({
                'value': place[0],
            });
            $('#memo').text (memo[0]);
            $('#time').attr({
                'value': time[0],
            });

            // セッションから取得したデータが複数であれば
            if(arrayCount > 2) {
                // 行先登録画面に登録覧を追加する
                for(let i = 2; i < arrayCount; i++) {
                    
                    let priceInput = '';
                    if (price[i-2] !== undefined && price[i-2] !== null && price[i-2] !== '') {
                        priceInput = `<input type="number" class="form-control" id="price[${i-2}]" name="price[${i-2}]" value="${price[i-2]}">`;
                    } else {
                        priceInput = `<input type="number" class="form-control" id="price[${i-2}]" name="price[${i-2}]" value="0">`;
                    }

                    $('.add-point').before(`<div id="js-plan-${i-1}">
                    <div class="list-group-item list-group-item-action justify-content-end align-items-center plan-sub">
                        <div class="money">
                        移動費：${priceInput}円
                        </div>
                        <div class="transportation">
                            移動手段：<select name="transportation[${i-2}]" id="transportation[${i-2}]">
                                        <option value="車" ${transportation[i-2] === '車' ? 'selected' : ''}>車</option>
                                        <option value="タクシー" ${transportation[i-2] === 'タクシー' ? 'selected' : ''}>タクシー</option>
                                        <option value="電車"${transportation[i-2] === '電車' ? 'selected' : ''}>電車</option>
                                        <option value="新幹線"${transportation[i-2] === '新幹線' ? 'selected' : ''}>新幹線</option>
                                        <option value="徒歩"${transportation[i-2] === '徒歩' ? 'selected' : ''}>徒歩</option>
                                        <option value="その他"${transportation[i-2] === 'その他' ? 'selected' : ''}>その他</option>
                                    </select>
                        </div>
                    </div>

                    <div class="list-group-item list-group-item-action align-items-center plan-start">
                        <div class="plan-start-main-session">
                            <div class="text-center">
                                <input type="time" class="form-control time" id="time[${i-2}]" name="time[${i * 2 - 3}]" placeholder="時間" value="${time[i * 2 - 3]}">
                                <input type="time" class="form-control time" id="time[${i-1}]" name="time[${i * 2 - 2}]" placeholder="時間" value="${time[i * 2 - 2]}">
                            </div>
                            <div>
                                <input type="text" class="form-control place" id="place[${i-1}]" name="place[${i-1}] " placeholder="経由地" value="${place[i - 1] ?? ''}">
                            </div>
                        </div>
                        <textarea class="w-100" name="memo[${i-1}]" id="memo[${i-1}]" placeholder="メモ">${memo[i-1] ?? ''}</textarea>
                    </div>

                    </div>`);
                }
            }
            // plan-id（経由地・時間・金額が何セット記入してあるか）を更新
            count = arrayCount-1;
            $('#js-plan').attr('data-plan-id', count);

            $('#placeNext').attr({
                'value': place[count],
                'name': `place[${count}]`,
            });
            $('#memoNext').text (memo[count]);

            $('#memoNext').attr({
                'name': `memo[${count}]`,
            });

            $('#timeNext').attr({
                'value': time[count * 2 - 1],
                'name': `time[${count * 2 - 1}]`,
            });

            $('#price').attr({
                'value': price[count - 1],
                'name': `price[${count - 1}]`,
            });
            $('#transportation').attr({
                'name': `transportation[${count - 1}]`,
            });
            $('#transportation option').each(function() {
                if ($(this).val() === transportation[count-1]) {
                    $(this).attr('selected', 'selected');
                }
            });

        }
        // セッションのデータを削除
        sessionStorage.clear();
    });
});

