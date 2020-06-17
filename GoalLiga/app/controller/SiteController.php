<?php
//This php page is responsible for controlling what the user sees
include_once '../global.php';

//Get which page the user is trying to view
$route = $_GET['route'];

$sc = new SiteController();

//Calls function based on the route
if ($route == 'admin') {
  $sc->admin();
} elseif($route == 'loginProcess') {
  $sc->loginProcess();
} elseif($route == 'logout') {
  $sc->logout();
} elseif($route == 'signUp') {
  $sc->signUp();
} elseif($route == 'home') {
  $sc->home();
} elseif($route == 'profile') {
  $sc->profile();
} elseif($route == 'changePwd') {
  $sc->changePwdProcess();
} elseif($route == 'deleteAccnt') {
  $sc->deleteAccnt();
} elseif($route == 'sign') {
  $sc->signUp();
} elseif($route == 'signUpProcess') {
  $sc->signUpProcess();
} elseif($route == 'makeAdmin') {
  $sc->makeAdmin();
} elseif ($route == 'viz') {
  $sc->viz();
} elseif ($route == 'visual') {
  $sc->visual();
}

/**
* Class that represents the controller for the site
**/
class SiteController {

  /**
  * This function generates the required JSON file in the format needed
  * to generate the file.
  **/
  public function viz() {

    //Array of users
    $children1 = array();
    //User count and user article count for incrementing
    $c1Count = 0;
    $c2Count = 0;

    //Load all users
    $users = User::loadAllUsers();
    //Iterate over all users
    foreach($users as $user) {
      $children2 = array();
      $c2Count = 0;
      //Get articles for user and iterate over articles
      $userArticles = NewsStory::loadAllStoriesForUser($user['username']);
      //Create an article node for all articles relevant to a user
      foreach($userArticles as $article) {
        $articleNode = array(
          'identifier' => 'article',
          'name' => $article['title'],
          'parent' => $user['username'],
          'articleID' => $article['id'],
          'userID' => $article['author_id']
        );
        $children2[$c2Count] = $articleNode;
        $c2Count++;
      }
      //Create a user node and save the article node array as a child of the user node
      $userNode = array(
        'name' => $user['username'],
        'parent' => "Users",
        'children' => $children2
      );
      $children1[$c1Count] = $userNode;
      $c1Count++;
    }
    $logID = 'false';
    $showAll = false;

    //Set permissions for users to be able to delete and edit articles
    if (isset($_SESSION['loggedInUserID'])) {
        $logID = $_SESSION['loggedInUserID'];
        if (isset($_SESSION['isAdmin'])) {
          $showAll = true;
        }
    }
    //Create root node
    $root = array(
      'name' => "Users",
      'parent' => "null",
      'children' => $children1,
      'logID' => $logID,
      'admin' => $showAll
    );

    //Create json object as required
    $json = array();
    $json[0] = $root;

    header('Content-Type: application/json');
    echo json_encode($json);
  }

  /**
  * Function that controls what the user sees on the visual tree page
  **/
  public function visual() {    
    $pageTitle = "Visual Tree";

    include_once SYSTEM_PATH.'/view/header.php';
    include_once SYSTEM_PATH.'/view/tree.php';
    include_once SYSTEM_PATH.'/view/footer.php';
  }

  /**
  * Function that authenticates the username and password entered by the user and redirects
  * the user to the home page
  **/
  public function loginProcess() {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = User::loadByUsername($username);
    if($user == null) {
      $_SESSION['msg'] = "Login failed. Invalid Username: $username";
      header('Location: '.BASE_URL.'/home'); exit();
    } elseif($user['password'] != $password) {
      $_SESSION['msg'] = 'Login failed. Your username/password combination is incorrect.';
      header('Location: '.BASE_URL.'/home'); exit();
    } else {
      //$_SESSION['username'] = $username;
      $_SESSION['loggedInUserID'] = $user['id'];
      $_SESSION['loggedInUserName'] = $user['username'];
      if ($user['role'] == 1) {
        $_SESSION['isAdmin'] = true;
      }
      $_SESSION['msg'] = 'Login successful!';
      header('Location: '.BASE_URL.'/home'); exit();
    }
  }

  /**
  * Function that verifies and changes password if required
  **/
  public function changePwdProcess() {
    $username = $_SESSION['loggedInUserName'];
    if (isset($_POST['pwdyes'])) {
      $newPassword = $_POST['newpwdcnfrm'];
      $newPassword2 = $_POST['newpwd'];
      $currentPassword = $_POST['currentpwd'];

      $user = User::loadByUsername($username);
      //Check if the password matches current password
      if($user['password'] != $currentPassword) {
          $_SESSION['msg'] = 'Your current password is incorrect';
          header('Location: '.BASE_URL.'/profile/'.$username); exit();
      }
      else {
        //Check if the new passwords match
        if ($newPassword != $newPassword2) {
          $_SESSION['msg'] = "The new passwords you entered do not match";
          header('Location: '.BASE_URL.'/profile/'.$username); exit();
        }
        else {
          //Update password
          User::updatePassword($user['id'], $newPassword);
          $_SESSION['msg'] = "You have succesfully changed your password";
          header('Location: '.BASE_URL.'/profile/'.$username); exit();
        }
      }
    }
    if (isset($_POST['no'])) {
      header('Location: '.BASE_URL.'/profile/'.$username); exit();
    }
  }

  /**
  * Function that logs the user out of the web server by destroying the session
  * and redirecting to the home page
  **/
  public function logout(){
    unset($_SESSION['loggedInUserID']); // unset session variable
    session_destroy(); // destroy session
    header('Location: '.BASE_URL.'/home'); exit(); // redirect to login page
  }

  /**
  * This function deletes an account from the databse including all events and articles
  * related to a user
  **/
  public function deleteAccnt() {
    $userID = $_GET['id'];
    $user = User::loadByID($userID);
    if (isset($_POST['yes'])) {
      User::deleteUser($user['username']);
      Event::deleteAllEventsForUser($userID);
      NewsStory::deleteAllArticlesForUser($userID);
      unset($_SESSION['loggedInUserID']); // unset session variable
      session_destroy(); // destroy session
      header('Location: '.BASE_URL.'/home'); exit(); // redirect to login page
    }
    if (isset($_POST['no'])) {
      header('Location: '.BASE_URL.'/profile/'.$user['username']); exit();
    }

  }

  /**
  * Function that controls what the user views on the home page of the website and
  * creates two variables containing the list of events and the articles to display
  **/
  public function home() {
    $events = Event::loadAllEvents();
    $articles = NewsStory::loadAllStories();
    $pageTitle = 'home';

    include_once SYSTEM_PATH.'/view/header.php';
    include_once SYSTEM_PATH.'/view/home.php';
    include_once SYSTEM_PATH.'/view/footer.php';
  }

  /**
  * Function that displays what the user sees on the profile page
  **/
  public function profile() {
    $pageTitle = 'profile';
    $username = $_GET['un'];
    //Get the relevant user and save to a variable
    $user = User::loadByUsername($username);
    $events = Event::loadAllEventsForUser($user['id']);
    //If the user does not exist within the database
    if($user == null) {
      $_SESSION['msg'] = 'User does not exist.';
      header('Location: '.BASE_URL.'/home'); exit();
    } else {
      //Call the php pages in succession to display on profile page
      include_once SYSTEM_PATH.'/view/header.php';
      include_once SYSTEM_PATH.'/view/profile.php';
      include_once SYSTEM_PATH.'/view/footer.php';
    }
  }

  /**
  * Function that controls what the user sees on the sign up page
  **/
  public function makeAdmin() {
    if (isset($_POST['makeAdm'])) {
      $adminName = $_SESSION['newAdmin'];
      $user = User::loadByUsername($adminName);
      if (is_null($user)) {
        $_SESSION['postMsg'] = "Invalid Username: $adminName";
      }
      else {
        User::makeAdmin($adminName);
        $_SESSION['postMsg'] = "$adminName was made an admin";
        // log the event
        $ev = new Event();
        $ev->event_type = Event::EVENT_TYPE['make_admin'];
        $ev->user_id = $user['id'];
        $ev = Event::insertEvent($ev);
      }
      header('Location: '.BASE_URL.'/profile/'.$_SESSION['loggedInUserName']); exit();
    }
    else {
      header('Location: '.BASE_URL.'/profile/'.$_SESSION['loggedInUserName']); exit();
    }
  }

  /**
  * Function that controls what the user sees on the sign up page
  **/
  public function signUp() {
    $script = "signUp";
    $pageTitle = "sign Up";

    include_once SYSTEM_PATH.'/view/header.php';
    include_once SYSTEM_PATH.'/view/signUp.php';
    include_once SYSTEM_PATH.'/view/footer.php';
  }

  /**
  * Function that validates the sign up and adds a new user to the database and
  * then logs the account
  **/
  public function signUpProcess() {
    $username = $_POST['username'];
    $chkExist = User::loadByUsername($username);
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $club = $_POST['club'];
    $json = array();
    //If the form is succesfully validated
    if (!empty($username) && !empty($password) && !empty($email) && !empty($firstName) && !empty($lastName) && (is_null($chkExist))) {
      $user = new User();
      $user->username = $username;
      $user->password = $password;
      $user->email = $email;
      $user->firstName = $firstName;
      $user->lastName = $lastName;
      $user->club = $club;
      User::insertUser($user);
      $newUser = User::loadByUsername($username);
      // log the event
      $ev = new Event();
      $ev->event_type = Event::EVENT_TYPE['new_user'];
      $ev->user_id = $newUser['id'];
      $ev = Event::insertEvent($ev);

      $json = array(
        'success' => 'success',
        'error' => 'You have succesfully signed up for our website.'
      );
    }
    else {
      //If the entered username is already in existence
      if (!is_null($chkExist)) {
        $json = array(
          'error' => 'Username is already taken'
        );
      }
      //If the form is incomplete
      else {
        $json = array(
          'error' => 'Please fill in all fields to submit the form'
        );
      }
    }
    header('Content-Type: application/json');
    echo json_encode($json);
  }

}
