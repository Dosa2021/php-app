$(function () {
  let $orders = $("#orders");

  $.ajax({
    dataType: "json", //データタイプはjsonを指定
    type: "GET", //値を得たいからGET
    url: "api/index.php", //ajaxBasicのなかのapi.phpにアクセス
    success: function (orders) {
      //通信成功時の処理
      $.each(orders, function (i, order) {
        $orders.append(
          "<li>id: " + order.id + ", title: " + order.title + "</li>",
        ); //eachで回してorderそれぞれの要素をorder.name / order.drinkとして出力
      });
    },
    error: function () {
      //通信失敗時の処理
      alert("error loading order");
    },
  });
});
