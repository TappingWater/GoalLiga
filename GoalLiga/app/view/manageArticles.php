<!-- HTML Body -->
<div class = "container4">
      <h2>My Articles</h2>
</div>
<div class="newPost">
  <a href="<?= BASE_URL ?>/postArticle" color="white">Post your story</a></div>
  <br>
  <br>
</div>
<!-- loops through the records in the SQL database and retrieves the required information -->
<?php foreach ($articles as $article): ?>
  <div  class = "container2">
    <div class="article2">
      <div class="articleImage">
          <!-- URL : https://images.daznservices.com/di/library/GOAL/80/ee/eden-hazard-sergio-ramos-real-madrid_12rqze76t8rph144xd42mfsybg.jpg?t=-1606818675&quality=60&w=1600 -->
          <img src="<?php echo $article['img']; ?>" alt="article_img">
      </div>
      <div class="articleDescription">
        <h4><?php echo $article['title']; ?></h4>
        <h5><?php echo $article['club']; ?></h5>
        <p><?php echo substr($article['body'], 0, 450)."................."; ?></p>
        <a class = "button" href="<?= BASE_URL ?>/news/<?php echo $article['id']; ?>">Details</a>
        <a class = "button" href="<?= BASE_URL ?>/news/edit/<?php echo $article['id']; ?>">Edit</a>
        <h5><?php echo "Posted on ".$article["date"]." | ".$article["comments"]." comments | ".$article["likes"]." likes | ".$article["dislikes"]." dislikes"; ?></h5>
      </div>
      <div class="clearFix">
      </div>
    </div>
  </div>
<?php endforeach; ?>
