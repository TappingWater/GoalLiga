<!-- Checks whether the user has logged in to display the new post button -->
<?php if (isset($_SESSION['loggedInUserID'])): ?>
  <div class="newPost">
    <a href="<?= BASE_URL ?>/postArticle" color="white">Post your story</a></div>
  </div>
<?php endif; ?>

<!-- Container2 div that contains the new-section and the match-section of the HTML -->
<div class="container2">
  <!-- News section of the HTML page -->
  <div id="news-section">
    <h3 class = "newsSector">Latest News</h3>

    <!-- Default article class -->
    <?php for ($i = 0; $i < 6 && $i < sizeof($articles); $i++): ?>
    <div class="article">
      <?php $article = $articles[$i]; ?>
      <!-- URL: https://e1.365dm.com/19/07/768x432/skysports-diego-costa-costa_4729408.jpg?20190727072420 -->
      <img src="<?php echo $article['img']; ?>" alt="newsarticle1">
      <h4><?php echo $article['title']; ?></h4>
      <h5><?php echo $article['club'] ?></h5>
      <p><?php echo substr($article['body'], 0, 400)."..........."; ?></p>
      <a class = "button" href="<?= BASE_URL ?>/news/<?php echo $article['id']; ?>">Read more</a>
    </div>
    <?php endfor; ?>
  </div>

  <!-- Match section of the HTML page -->
  <div id="match-section">
      <h3>Recent Feed</h3>
    <!-- Create a feed showing the events and the dates where these events occured -->
    <?php for ($i=0; $i < 20 && $i < sizeof($events) ; $i++): ?>
      <?php $event = $events[$i]; ?>
      <h4><?= formatEvent($event) ?></h4>
      <h5><?php echo $event['date_created']; ?></h5>
    <?php endfor; ?>
  </div>
  <div class="clearFix"></div>
</div>
