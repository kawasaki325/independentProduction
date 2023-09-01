$(function () {
    // .faq-questionをクリックしたとき
    $(".js-detail").click(function () {
      //クリックした要素の隣の要素をスライドする
      $(this).parent().next('.js-content').slideToggle();
    });
  });