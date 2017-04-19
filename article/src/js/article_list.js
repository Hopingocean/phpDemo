$(document).ready(function () {
  // 请求文章列表
  function getArticleList() {
    $.ajax({
      url: config.basePath + config.articleList,
      type: 'GET',
      success: function (data) {
        var obj = JSON.parse(data);
        console.log(obj);
        for (var i = 0; i < obj.length; i++) {
          var html = html
            + "<tr>"
            + "<td class='articleId'>"
            + obj[i].id
            + "</td>"
            + "<td>"
            + obj[i].title
            + "</td>"
            + "<td>"
            + obj[i].author
            + "</td>"
            + "<td>"
            + obj[i].introduce
            + "</td>"
            + "<td>"
            + obj[i].content
            + "</td>"
            + "<td>"
            + "<button class='btn btn-info btn-sm' type='button'>编辑</button>"
            + "<button class='btn btn-danger btn-sm' type='button'>删除</button>"
            + "</td>"
            + "</tr>"
            ;
        }
        $('tbody').html(html);
      },
      error: function (data) {
        console.log(data);
      }
    });
  }
  getArticleList();
  // 编辑文章
  $('.table').on('click', '.btn-info', function () {
    var id = $(this).parent().siblings('.articleId').text();
    window.location.href = 'article_modify.html?id=' + id;  
  })
  // 删除文章
  $('.table').on('click', '.btn-danger', function () {
    var id = $(this).parent().siblings('.articleId').text();
    $.ajax({
      url: config.basePath + config.articleDel,
      type: 'GET',
      data: {
        id: id
      },
      success: function (data) {
        getArticleList();
      },
      error: function (data) {
        console.log(data);
      }
    });
  })
});