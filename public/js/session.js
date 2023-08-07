$(function() {
    // 行先登録画面のロードがあったら
    $(document).ready(function() {
        // plan-id（経由地・時間・金額が何セット記入してあるか）を取得
        let count = $('#js-plan').attr('data-plan-id');
        // セッションからデータを取得
        var goal = sessionStorage.getItem('goal');
        var date = sessionStorage.getItem('date');
        var place = sessionStorage.getItem('place');
        var time = sessionStorage.getItem('time');
        // セッションから取得したデータを使えるようにする
        goal = JSON.parse(goal);
        date = JSON.parse(date);
        place = JSON.parse(place);
        time = JSON.parse(time);
        // もしセッションから取得したデータがあれば
        if(place.length > 0) {
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
            $('#time').attr({
                'value': time[0],
            });
            // セッションから取得したデータが複数であれば
            if(place.length > 1) {
                // 行先登録画面に登録覧を追加する
                for(let i = 1; i < place.length; i++) {
                    // 値がnullのときnullを表示させないようにしたい

                    $('#js-plan').append(`<div><label for="place">経由地</label> <input type="text" class="form-control" id="place[${i}]" name="place[${i}] " placeholder="経由地" value="${place[i]}">
                    <label for="time">時間</label><input type="time" class="form-control" id="time[${i}]" name="time[${i}]" placeholder="時間" value=${time[i]}></div>`);
                }
            }
            // plan-id（経由地・時間・金額が何セット記入してあるか）を更新
            $('#js-plan').attr('data-plan-id', place.length - 1);
        }
        // セッションのデータを削除
        sessionStorage.clear();
    });
});


