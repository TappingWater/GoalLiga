$(document).ready(function(){

    /**
    * this function is used to rearrange the articles in the list page according to different attributes
    **/
    $('#clubSort').change(function () {
      var clubName = $(this).val();
      //Remove all articles so that they can be rearranged
      $(".article2").remove();
      $.get(
        //Send for sort process
        base_url + '/news/sortClub/' + clubName,
        function(data) {
          for (var i = 0; i < data.length; i++) {
              var addArticle = '<div class="article2"> <div class="articleImage"> <!-- URL : https://images.daznservices.com/di/library/GOAL/80/ee/eden-hazard-sergio-ramos-real-madrid_12rqze76t8rph144xd42mfsybg.jpg?t=-1606818675&quality=60&w=1600 --> <img src='+data[i].img+' alt="article_img"></div>';
              var description = data[i].body.substring(0, 450) + '.......................';
              var articleDescription = '<div class="articleDescription"> <!-- Retrieve the article information --> <h4>'+data[i].title+'</h4> <h5>'+data[i].club+'</h5> <p>'+description+'</p> <a class = "button" href="'+base_url+'/news/'+data[i].id+'">Read more</a> <br> <br> <span>Posted by: </span> <a href="'+base_url+'/profile/'+data[i].author+'">'+data[i].author+'</a>';
              var stats = '<h5>Posted on '+data[i].date+' | '+data[i].comments+' comments | '+data[i].likes+' likes | '+data[i].dislikes+' dislikes</h5>';
              var end = '</div> <div class="clearFix"> </div> </div> </div>';
              var final = addArticle + articleDescription +stats + end;
              $('#articleList').append(final);

          }
          console.log(data[0].img);
        }, "json"
      );
    });

});
