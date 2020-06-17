<!-- Body of the HTML page -->
<!-- Container4 div -->
<div class="container4">
  <!-- PHP codes that checks form validation -->
  <?php  if (isset($_SESSION['postMsg'])): ?>
      <div class="alert">
          <span><?php echo $_SESSION['postMsg']; ?><span>
      </div>
  <?php endif; ?>
  <!-- get the needed information from the sql database and display it in the form for editing -->
  <form name = "postForm" class="postStory" method="POST" action="<?= BASE_URL ?>/updateProcess" ?>
    <span>Article title: </span>
    <textarea name="title" rows="1" cols="80" placeholder="Title" class = "submitInfo"><?php echo $article['title']; ?></textarea>
    <br>
    <div class="associatedClub">
      <span>Associated Club:</span>
      <select class="clublist" name="clubs">
        <option value="Real Madrid">Real Madrid</option>
        <option value="FC Barcelona">Barcelona</option>
        <option value="Atletico Madrid">Atletico Madrid</option>
      </select>
    </div>
    <span>Image URL:</span>
    <textarea name="img" rows="1" cols="80" placeholder="Img Url" class = "submitInfo"><?php echo $article['img']; ?></textarea>
    <span>Description:</span>
    <textarea name="description" rows="30" cols="320" placeholder="Description" class="submitInfo"><?php echo $article['body']; ?></textarea>
    <br>
    <input type="checkbox" name="update"> Update me when someone replies to my post
    <?php $_SESSION['editID'] = $article['id']; ?>
    <br>
    <input type="submit" name="submit" value="Submit" class="submitBtn">
  </form>
  <div class="clearFix">
  </div>
</div>
