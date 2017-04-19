$(document).ready(function () {
  $('.btn').click(function () {
    var info = {};
    info.title = $("input[name='title']").val();
    info.author = $("input[name='author']").val();
    info.introduce = $("textarea[name='introduce']").val();
    info.content = $("textarea[name='content']").val();
    $.ajax({
      url: config.basePath + config.articleAdd,
      type: 'POST',
      data: info,
      success: function (data) {
        var obj = JSON.stringify(data);
        console.log(obj);
        window.location.href = 'index.html';
      },
      error: function (data) {
        console.log(data);
      }
    });
  });
});
