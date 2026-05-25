$(function () {
  $.ajax({
    dataType: "json", //データタイプはjsonを指定
    type: "GET", //値を得たいからGET
    url: "api/index.php", //ajaxBasicのなかのapi.phpにアクセス
    success: function (orders) {
      //通信成功時の処理
      console.log("hoge-res-------------");

      console.log(orders); //consoleにArrayで{jsonデータ}が出ていたらOK
      //   $.each(orders, function (i, order) {
      //     $orders.append(
      //       "<li>name: " + order.name + ", drink: " + order.drink + "</li>",
      //     ); //eachで回してorderそれぞれの要素をorder.name / order.drinkとして出力
      //   });
    },
    error: function () {
      //通信失敗時の処理
      alert("error loading order");
    },
  });
});
