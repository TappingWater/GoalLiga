<!-- HTML body containing the contents of the article -->
<!-- Div that wraps the main article -->
<div class="container4">
  <!-- Display the delete button if the user is a admin or the original author -->
  <?php if (isset($_SESSION['loggedInUserID'])): ?>
  <?php if (showDeleteButton($_SESSION['loggedInUserID'], $article['author_id'])): ?>
    <br>
    <br>
    <!-- Form for deleting an article -->
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" style='display:inline;'>
        <input type = "submit" name = "delete" value = "Delete" class = "button"></input>
    </form>
    <!-- Confirmation form for deleting an article -->
    <?php if (isset($_POST["delete"])): ?>
        <?php echo "Are you sure you want to delete this article:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" ?>
        <a href="<?= BASE_URL ?>/news/delete/<?= $article['id'] ?>" class = "button">Yes</a>
        <a href="<?= BASE_URL ?>/news/<?= $article['id'] ?>" class = "button" onclick = "<?php unset($_POST["delete"]);?>">No</a>
    <?php endif; ?>
  <?php endif; ?>
  <?php endif; ?>
  <h2><?php echo $article['title']; ?></h2>
  <h3><?php echo $article['club']; ?></h3>
  <a href="<?= BASE_URL ?>/profile/<?php echo $article['author'] ?>"><?php echo $article['author']; ?></a>
  <div></div>
  <i>Posted on: <?php echo $article['date']; ?></i>
  <!-- URL : https://images.daznservices.com/di/library/GOAL/80/ee/eden-hazard-sergio-ramos-real-madrid_12rqze76t8rph144xd42mfsybg.jpg?t=-1606818675&quality=60&w=1600 -->
  <img src="<?php echo $article['img']; ?>" alt="article-img">
  <br>
  <?php echo nl2br($article['body']); ?>
</div>
