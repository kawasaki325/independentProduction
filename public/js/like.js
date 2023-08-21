$(function(){
    // いいね！がクリックされたとき
    $('.js-like').click(function (){
        const this_obj = $(this);
        const goal_id = $(this).data('goal-id');
        // const user_id = $(this).data('user-id');
        const like_id = $(this).data('like-id');
        const like_count_obj = $(this).parent().find('.js-like-count');
        let like_count = Number(like_count_obj.html());

        if (like_id) {
            // いいね！取り消し
            // 非同期通信
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/plans/share/like',
                method: 'POST',
                data: {
                    'like_id' : like_id,
                    'goal_id' : goal_id,
                },
            })
            // いいね！カウントを減らす
            .done(() => {
                like_count--;
                like_count_obj.html(like_count);
                this_obj.data('like-id', null);

                // いいね！ボタンの色をグレーに変更
                // $(this).find('img').attr('src', '../img/img/icon-heart.svg');
                $(this).find('button').html('いいねする');
            })
            .fail((data) => {
                alert('処理中にエラーが発生しました。');
                console.log(data);
            });
            
        } else {
            // いいね！付与
            // 非同期通信
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/plans/share/like',
                method: 'POST',
                data: {
                    'like_id' : like_id,
                    'goal_id' : goal_id,
                },
            })
            // いいね!が成功
            .done((data) => {
                // いいね！カウントを増やす
                like_count++;
                like_count_obj.html(like_count);
                this_obj.data('like-id', 1);

                // いいね！ボタンの色を青に変更
                $(this).find('button').html('いいねを外す');
            })
            .fail((data) => {
                alert('処理中にエラーが発生しました。');
                console.log(data);
            });

        }
    });
})