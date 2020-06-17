<!-- Container2 div that contains the new-section and the match-section of the HTML -->
<div class="container2">  
  <div class="clearFix">
  </div>
  <div class="dropDown">
      <span>Filter by club</span>
      <select name="club" id = "clubSort">
        <option value="ac">No filter</option>
        <option value="rm">Real Madrid</option>
        <option value="fcb">Barcelona</option>
        <option value="atl">Atletico madrid</option>
      </select>
  </div>
  <div class="clearFix">
  </div>
  <div class="newsSector">
  </div>
  <!--Loops through all the articles in the sql and displays them -->
  <?php foreach ($articles as $article): ?>
    <div  class = "container2" id="articleList">
      <div class="article2">
        <div class="articleImage">
            <!-- URL : https://images.daznservices.com/di/library/GOAL/80/ee/eden-hazard-sergio-ramos-real-madrid_12rqze76t8rph144xd42mfsybg.jpg?t=-1606818675&quality=60&w=1600 -->
            <img src="<?php echo $article['img']; ?>" alt="article_img">
        </div>
        <div class="articleDescription">
          <!-- Retrieve the article information -->
          <h4><?php echo $article['title']; ?></h4>
          <h5><?php echo $article['club']; ?></h5>
          <p><?php echo substr($article['body'], 0, 450)."................."; ?></p>
          <a class = "button" href="<?= BASE_URL ?>/news/<?php echo $article['id']; ?>">Read more</a>
          <br>
          <br>
          <span>Posted by: </span>
          <a href="<?= BASE_URL ?>/profile/<?php echo $article['author'] ?>"><?php echo $article["author"]; ?></a>
          <h5><?php echo "Posted on ".$article["date"]." | ".$article["comments"]." comments | ".$article["likes"]." likes | ".$article["dislikes"]." dislikes"; ?></h5>
        </div>
        <div class="clearFix">
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<div class="clearFix">
</div>
