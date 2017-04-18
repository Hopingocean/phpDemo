$(document).ready(function () {
  $('.btn').click(function () {
    var info = {};
    info.title = $("input[name='title']").val();
    info.author = $("input[name='author']").val();
    info.introduce = $("textarea[name='introduce']").val();
    info.content = $("textarea[name='content']").val();
    $.ajax({
      url: 'app/article_add_handle.php',
      type: 'POST',
      data: info,
      success: function (data) {
        var obj = JSON.stringify(data);
        console.log(obj);
      },
      error: function (data) {
        console.log(data);
      }
    });
  });
  页面加载请求默认数据
  $.ajax({
    url: 'app/article_list_handle.php',
    type: 'GET',
    contentType: "application/x-www-form-urlencoded; charset=utf-8", 
    success: function (data) {
      console.log(data);
    },
    error: function (data) {
      console.log(data);
    }
  });
});
