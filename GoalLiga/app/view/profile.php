<!-- HTML body containing the contents of the profile -->
<!-- Div that wraps the main profile -->
<div class="container4">
  <h2><?php echo "Profile: ".$user['username']; ?></h2>
  <!-- PHP codes that checks form validation -->
  <?php  if (isset($_SESSION['postMsg'])): ?>
      <div class="alert">
          <span><?php echo $_SESSION['postMsg']; ?><span>
      </div>
  <?php endif; ?>
  <?php unset($_SESSION['postMsg']); ?>
  <?php if (isset($_SESSION["loggedInUserID"])): ?>
    <!-- Show the change password option if the user is looking at his own profile -->
    <?php if (($_SESSION['loggedInUserName'] == $user['username'])) : ?>
      <?php if(isset($_SESSION['isAdmin'])): ?>
        <!-- Form for granting administrative privileges -->
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" style='display:inline;'>
            <span>Grant administrative privileges to user: </span>
            <input type="text" name="adminName" class = "textBox">
            <br>
            <br>
            <input type = "submit" name = "makeAdmin" value = "Make Admin" class = "button" style = "float:right"></input>
            <!-- Confirmation form for deleting an article -->
        </form>
        <?php if (isset($_POST["makeAdmin"])): ?>
          <form action="<?= BASE_URL ?>/makeAdmin" method="POST">
            <?php echo "Are you sure you want to grant administrative privileges to this user:" ?>
            <br>
            <?php $_SESSION['newAdmin'] = $_POST['adminName']; ?>
            <input type = "submit" name = "makeAdm" value = "Yes" class = "button"></input>
            <input type = "submit" name = "makeAdmN" value = "No" class = "button"></input>
          </form>
        <?php endif; ?>
      <?php endif; ?>
      <br>
      <br>
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" style='display:inline;'>
          <input type = "submit" name = "pwdchange" value = "Change Password" class = "button"></input>
      </form>
      <!-- Change password form -->
      <?php if (isset($_POST["pwdchange"])): ?>
        <br>
        <br>
        <form action="<?= BASE_URL ?>/pwdChange" method="POST">
          <span class = "spancls">Current Password:</span>
          <input type = "password" name = "currentpwd" class = "textBox"></input>
          <br>
          <span class = "spancls">New Password:</span>
          <input type = "password" name = "newpwd" class = "textBox"></input>
          <br>
          <span class = "spancls">Confirm New Password:</span>
          <input type = "password" name = "newpwdcnfrm" class = "textBox"></input>
          <br>
          <br>
          <?php echo "Are you sure you want to Change your password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" ?>
          <input type = "submit" name = "pwdyes" value = "Yes" class = "button"></input>
          <input type = "submit" name = "no" value = "No" class = "button"></input>
        </form>
      <?php endif; ?>
      <br>
      <br>
    <?php endif; ?>    
  <?php endif; ?>

  <?php if (isset($_SESSION["loggedInUserID"])): ?>
    <?php if (($_SESSION['loggedInUserName'] == $user['username']) || (isset($_SESSION['isAdmin']))) :?>
    <!-- Form for deleting an article -->
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" style='display:inline;'>
        <input type = "submit" name = "delete" value = "Delete Account" class = "button"></input>
    </form>
    <?php endif; ?>
    <!-- Confirmation form for deleting an article -->
    <?php if (isset($_POST["delete"])): ?>
      <form action="<?= BASE_URL ?>/deleteAccnt/<?= $user['id'] ?>" method="POST">
        <?php echo "Are you sure you want to delete this account:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" ?>
        <input type = "submit" name = "yes" value = "Yes" class = "button"></input>
        <input type = "submit" name = "no" value = "No" class = "button"></input>
      </form>
    <?php endif; ?>
<?php endif; ?>
  <div class="profattr">
    <strong>Email:</strong>
    <i><?php  echo $user['email'] ?></i>
  </div>
  <div class="profattr">
    <strong>First Name:</strong>
    <i><?php  echo $user['firstName'] ?></i>
  </div>
  <div class="profattr">
    <strong>Last Name:</strong>
    <i><?php  echo $user['lastName'] ?></i>
  </div>
  <div class="profattr">
    <strong>Date registered:</strong>
    <i><?php  echo $user['date_registered'] ?></i>
  </div>
  <div class="profattr">
    <strong>Favorite Club:</strong>
    <i><?php  echo $user['favoriteClub'] ?></i>
  </div>
  <br>
  <br>

  <div class="My-Feed">
    <!-- Create a feed showing the events and the dates where these events occured -->
    <h2><?php echo $user['username']."'s feed" ?></h2>
    <?php for ($i=0; $i < 10 && $i < sizeof($events) ; $i++): ?>
      <?php $event = $events[$i]; ?>
      <h5><?= formatEvent($event) ?></h4>
      <h5><?php echo $event['date_created']; ?></h5>
    <?php endfor; ?>
  </div>

</div>
