<!-- Lets user see the option to create article if user is logged in -->
<?php if(isset($_SESSION['loggedInUserID'])): ?>
  <div class = "container" id="createPanel">
    <input type="button" class = "pButton" name="createArticle" value="Create Article" id= "createArticleBtn">
  </div>
<?php endif; ?>
<!-- Create panel to display node titles -->
<div class = "container" id="panel">
  <label>Title: <input type="text" id="editTitle"></label>
  <input type="button" name = "detailBtn" id="detailBtn" value="More Details">
</div>
<!--Delete and edit article button div -->
<div class="container4" id='pButtons' style="display:none">
  <input type="button" class = "pButton" name="editTitle" id="editArticleBtn" value="Edit Article">
  <input type="button" class = "pButton" name="deleteArticle" value="Delete Article" id= "deleteArticleBtn">
</div>
<!-- Delete confirmation div -->
<div class="container4" id = 'dltCnfrm' style ="display:none">
  <label>Are you sure you want to delete this article: </label>
  <input class='dCnfrm' type="button" name="yes" value="Yes" id="dltYes">
  <input class = 'dCnfrm' type="button" name="no" value="No" id ="dltNo">
</div>
<!-- Diagram div to which the svg element is appended to -->
<diagram class = "diagram">
  <!-- Reference the d3 library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
  <script src="<?= BASE_URL ?>/public/js/intTree.js"></script>
</diagram>
