
<!-- Body of the HTML page -->
<!-- Container4 div -->
<div class="container4">
  <!-- PHP codes that checks form validation -->
  <?php  if (isset($_SESSION['postMsg'])): ?>
      <div class="alert">
          <span><?php echo $_SESSION['postMsg']; ?><span>
      </div>
  <?php endif; ?>
  <?php unset($_SESSION['postMsg']); ?>
  <div class="invalidTerms">

  </div>
  <!-- Article submission form -->
  <form name = "postForm" class="postStory" method="POST" action="<?= BASE_URL ?>/news/submit/process" >
    <span>Article title:</span>
    <!-- If any of the form variables are set already sets the form values to the previous inputs -->
    <input name = 'title' type = "text" placeholder="Title" class = "submitInfo" id = "submitTitle" value = "<?php echo isset($_SESSION['postTitle']) ? $_SESSION['postTitle'] : ''; ?>">
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
    <textarea name="img" rows="1" cols="80" placeholder="Img Url" class = "submitInfo"><?php echo isset($_SESSION['postImg']) ? $_SESSION['postImg'] : ''; ?></textarea>
    <span>Description:</span>
    <textarea name="description" rows="30" cols="320" placeholder="Description" class="submitInfo"><?php echo isset($_SESSION['postDescription']) ? $_SESSION['postDescription'] : ''; ?></textarea>
    <br>
    <input type="checkbox" name="update"> Update me when someone replies to my post
    <br>
    <input type="submit" name="submit" value="Submit" class="submitBtn" id = "submitBtn">
  </form>
  <div class="clearFix">
  </div>
</div>
