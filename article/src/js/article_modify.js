$(document).ready(function () {
  $('.btn').click(function () {
    // 提交修改信息
    var info = {};
    info.id = $("input[name='id']").val();
    info.title = $("input[name='title']").val();
    info.author = $("input[name='author']").val();
    info.introduce = $("textarea[name='introduce']").val();
    info.content = $("textarea[name='content']").val();
    $.ajax({
      url: config.basePath + config.articleModify,
      type: 'POST',
      data: info,
      success: function (data) {
        console.log(data);
        window.location.href = 'index.html';
      },
      error: function (data) {
        console.log(data);
      }
    });
  });
  // 页面加载请求默认数据
  var id = getLocationSearch('id');
  $.ajax({
    url: config.basePath + config.articleInfo,
    type: 'GET',
    data: {
      id: id
    },
    success: function (data) {
      data = JSON.parse(data);
      console.log(data);
      var id = data.id;
      var title = data.title;
      var author = data.author;
      var introduce = data.introduce;
      var content = data.content;
      $("input[name = 'id']").val(id);
      $("input[name = 'title']").val(title);
      $("input[name = 'author']").val(author);
      $("textarea[name = 'introduce']").val(introduce);
      $("textarea[name = 'content']").val(content);
    },
    error: function (data) {
      console.log(data);
    }
  });
});