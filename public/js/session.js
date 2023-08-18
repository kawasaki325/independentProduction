$(function() {
    // 行先登録画面のロードがあったら
    $(document).ready(function() {
        // plan-id（経由地・時間・金額が何セット記入してあるか）を取得
        let count = $('#js-plan').attr('data-plan-id');
        // セッションからデータを取得
        var goal = sessionStorage.getItem('goal');
        var date = sessionStorage.getItem('date');
        var place = sessionStorage.getItem('place');
        var place = sessionStorage.getItem('price');
        var memo = sessionStorage.getItem('memo');
        var time = sessionStorage.getItem('time');
        // セッションから取得したデータを使えるようにする
        goal = JSON.parse(goal);
        date = JSON.parse(date);
        place = JSON.parse(place);
        place = JSON.parse(price);
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
            $('#place').attr({
                'value': price[0],
            });
            $('#memo').text (memo[0]);
            $('#time').attr({
                'value': time[0],
            });
            // セッションから取得したデータが複数であれば
            if(arrayCount > 1) {
                // 行先登録画面に登録覧を追加する
                for(let i = 1; i < arrayCount; i++) {
                    // 値がnullのときnullを表示させないようにしたい
                    $('#js-plan').append(`<div id="js-plan-${i}""><label for="place">経由地</label> <input type="text" class="form-control" id="place[${i}]" name="place[${i}] " placeholder="経由地" value="${place[i] ?? ''}">
                    <label for="time">時間</label><input type="time" class="form-control" id="time[${i}]" name="time[${i}]" placeholder="時間" value="${time[i]}">
                    <label for="place">金額</label><input type="number" class="form-control" id="price[${i}]" name="price[${i}]" value="${price[i]}">
                    <label for="memo">メモ</label><textarea name="memo[${i}]" id="memo[${i}]" placeholder="メモ">${memo[i] ?? ''}</textarea></div>`);
                }
            }
            // plan-id（経由地・時間・金額が何セット記入してあるか）を更新
            $('#js-plan').attr('data-plan-id', arrayCount - 1);
        }
        // セッションのデータを削除
        sessionStorage.clear();
    });
});


