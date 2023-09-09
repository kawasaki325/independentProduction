$(function(){
    // いいね！がクリックされたとき
    $('.js-follow').click(function (){
        const this_obj = $(this);
        const user_id = $(this).data('user-id');
        const follow_id = $(this).data('follow-id');
        const followed_count_obj = $(this).parent().find('.js-follow-count').find('.js-followed-count');
        let followed_count = Number(followed_count_obj.html());

        if (follow_id) {
            // フォロー解除
            // 非同期通信
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/users/individual/follow',
                method: 'POST',
                data: {
                    'follow_id' : follow_id,
                    'user_id' : user_id,
                },
            })
            // フォロワーカウントを減らす
            .done(() => {
                followed_count--;
                followed_count_obj.html(followed_count);
                this_obj.data('follow-id', null);

                // テキストを変更
                $(this).find('button').html('フォローする');
            })
            .fail((data) => {
                alert('処理中にエラーが発生しました。');
                console.log(data);
            });
            
        } else {
            // フォローする
            // 非同期通信
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/users/individual/follow',
                method: 'POST',
                data: {
                    'follow_id' : follow_id,
                    'user_id' : user_id,
                },
            })
            // いいね!が成功
            .done((data) => {
                // フォロワーカウントを増やす
                followed_count++;
                followed_count_obj.html(followed_count);
                this_obj.data('follow-id', 1);

                // テキストを変更
                $(this).find('button').html('フォローを外す');
            })
            .fail((data) => {
                alert('処理中にエラーが発生しました。');
                console.log(data);
            });


        }
    });
})