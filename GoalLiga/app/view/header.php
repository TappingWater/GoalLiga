<?php include_once SYSTEM_PATH.'/view/helpers.php'; ?>

<!doctype html>
<html lang="en">
	<head>
    <!-- Meta features of the website -->
		<meta charset="utf-8">
    <!-- fix Chrome device emulator -->
		<meta name="viewport" content="width=device-width">
    <meta name="description" content="Social Media site for La Liga fans">
    <meta name="keywords" content="La Liga, Spanish Soccer, Goal Liga, Spain soccer, laliga">
    <meta name="author" content="Chanaka Perera">

    <title>Goal Liga | <?= $pageTitle ?></title>
		<link rel="stylesheet" href="<?= BASE_URL ?>/public/css/goalLigaStyle.css">
		<!-- URL: https://cdn.iconscout.com/icon/premium/png-256-thumb/soccer-97-682900.png -->
    <link rel="icon" href="<?= BASE_URL ?>/public/img/soccer-icon.png" type="image/ico">

    <!-- Enabling javaScript for the website -->
		<script>
			var base_url = '<?= BASE_URL ?>'; // give JS access to PHP's BASE_URL
		</script>
		<!-- Reference the jquery library -->
		<script src="<?= BASE_URL ?>/public/js/jquery-3.4.1.min.js"></script>
		<!-- If there are any additional script files for the specific view page -->
		<?php if (isset($script)): ?>
			<script src="<?= BASE_URL ?>/public/js/<?= $script ?>.js"></script>
		<?php endif; ?>
	</head>

  <!--Body of the HTMl page -->
  <body>
    <!-- Header of the HTML page -->
    <header>
        <div class="container">
          <div id = 'branding'>
            <!-- URL: https://cdn.iconscout.com/icon/premium/png-256-thumb/soccer-97-682900.png -->
            <img src="<?= BASE_URL ?>/public/img/soccer-icon.png" alt="soccer icon">
            <h1><span class = "highlight">Goal Liga</span> - Avenue for La Liga Soccer News</h1>
          </div>
          <?php if (!isset($_SESSION['loggedInUserID'])): ?>
            <form action="<?= BASE_URL ?>/login/process" method="POST">
										<a href="<?= BASE_URL ?>/signUp" class = "login-button">Sign Up</a>
                    <input type = "submit" name = "login" value = "Log In" class = "login-button"></input>
                    <input name = "password" type = "password" rows="1" cols="15" placeholder="password" class = "login-button"></textarea>
                    <input name = "username" type = "text" rows="1" cols="15" placeholder="username" class = "login-button"></textarea>
            </form>
          <?php endif; ?>
          <!-- what to display if logged in -->
          <?php if (isset($_SESSION['loggedInUserID'])): ?>
          	<a href="<?= BASE_URL ?>/profile/<?php echo $_SESSION['loggedInUserName']; ?>" class = "login-button"><?php echo $_SESSION['loggedInUserName'] ?></a>
						<a href="<?= BASE_URL ?>/logout" class = "login-button">Log Out</a></p>
          <?php endif; ?>
        </div>
    </header>

    <!-- Navigation bar of the HTML page -->
    <nav>
      <div class="container">
        <ul>
          <li><a href="<?= BASE_URL ?>/Home">Home</a></li>
          <li><a href="<?= BASE_URL ?>/News">News</a></li>
					<li><a href="<?= BASE_URL ?>/visual">Article Tree</a></li>
					<!-- If user is logged in allows him to view his profiles and articles he/she has posted -->
          <?php if (isset($_SESSION['loggedInUserID'])): ?>
            <li><a href="<?= BASE_URL ?>/myArticles">Manage Articles</a></li>
            <li><a href="<?= BASE_URL ?>/profile/<?php echo $_SESSION['loggedInUserName']; ?>">Manage Profile</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>

		<?php if(isset($_SESSION['msg'])): ?>
			<div class="alert">
				<?= $_SESSION['msg'] ?>
			</div>
		<?php unset($_SESSION['msg']); ?>
		<?php endif; ?>
