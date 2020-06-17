<?php

include_once '../global.php';
//include_once '../model/classes/NewsStory.php';

$route = $_GET['route'];

$nc = new NewsController();

//Controls what the user sees on the webserver
if ($route == 'list') {
  $nc->list();
} elseif ($route == 'add') {
  $nc->add();
} elseif ($route == 'addProcess') {
  $nc->addProcess();
} elseif ($route == 'detail') {
  $nc->detail();
} elseif ($route == 'edit') {
  $nc->edit();
} elseif ($route == 'editProcess') {
    $nc->editProcess();
} elseif ($route == 'delete') {
  $nc->deleteProcess();
} elseif ($route == 'manageArticles') {
  $nc->manage();
} elseif ($route == 'sortClub') {
  $nc->sortClub();
}


/**
* Class that represents how news articles are displayed on the
* webserver
**/
class NewsController {

  /**
  * This function is used to sort the news list by their respectives
  * club
  **/
  public function sortClub() {
    $club = $_GET['club'];
    //If no option is selected shows all articles
    if ($club == "ac") {
        $articles = NewsStory::loadAllStories();
    }
    //Select club name based on select name
    else {
      if ($club == "rm") {
        $clubname = "Real Madrid";
      }
      else if ($club == "fcb") {
        $clubname = "FC Barcelona";
      }
      else if ($club == "atl") {
        $clubname = "Atletico Madrid";
      }
      $json = array();
      $articles = NewsStory::filterByClub($clubname);
    }
    //Create json object by looping thorugh array
    for ($i = 0; $i < sizeof($articles); $i++) {
      $json[$i]['img'] = $articles[$i]['img'];
      $json[$i]['title'] = $articles[$i]['title'];
      $json[$i]['club'] = $articles[$i]['club'];
      $json[$i]['body'] = $articles[$i]['body'];
      $json[$i]['id'] = $articles[$i]['id'];
      $json[$i]['author'] = $articles[$i]['author'];
      $json[$i]['date'] = $articles[$i]['date'];
      $json[$i]['comments'] = $articles[$i]['comments'];
      $json[$i]['likes'] = $articles[$i]['likes'];
      $json[$i]['dislikes'] = $articles[$i]['dislikes'];
    }
    header('Content-Type: application/json');
    echo json_encode($json);
  }



  /**
  * This function controls what is displayed on the news page of the server
  **/
  public function list() {
    $articles = NewsStory::loadAllStories();
    $script = "list";
    $pageTitle = "News";

    include_once SYSTEM_PATH.'/view/header.php';
    include_once SYSTEM_PATH.'/view/list.php';
    include_once SYSTEM_PATH.'/view/footer.php';
  }

  /**
  * this function controls what the user sees when the user is trying to post a
  * new article to the web server.
  **/
  public function add() {
    $pageTitle = 'Post Article';
    $script = 'addNews';

    include_once SYSTEM_PATH.'/view/header.php';
    include_once SYSTEM_PATH.'/view/add.php';
    include_once SYSTEM_PATH.'/view/footer.php';
  }

  /**
  * this function controls what the user sees when the user is trying to edit an
  * existing article in the web server.
  **/
  public function edit() {
    $articleID = $_GET['storyID'];
    $article = NewsStory::loadByID($articleID);
    $pageTitle = 'Update Article';
    include_once SYSTEM_PATH.'/view/header.php';
    include_once SYSTEM_PATH.'/view/edit.php';
    include_once SYSTEM_PATH.'/view/footer.php';
  }

  /**
  * This function is used to get the needed information from the post and add the article
  * to the database and logs the event
  **/
  public function editProcess() {
    // get form data
    $title = $_POST['title'];
    $club = $_POST['clubs'];
    $description = $_POST['description'];
    $img_url = $_POST['img'];
    $notify = 0;
    if (isset($_POST['update'])) {
        $notify = 1;
    }
    if (!empty($title) && !empty($description)) {
        // save new NewsStory to database
        $story = new NewsStory();
        $story->title = $title;
        $story->club = $club;
        $story->description = $description;
        $story->img_url = $img_url;
        $story->notify = $notify;
        NewsStory::updateStory($_SESSION['editID'], $story);

        // log the event
        $ev = new Event();
        $ev->event_type = Event::EVENT_TYPE['update_story'];
        $ev->user_id = $_SESSION['loggedInUserID'];
        $ev->story_id = $_SESSION['editID'];
        $ev = Event::insertEvent($ev);

        //Remove the session variables after form has been succesfully submitted
        unset($_SESSION['postTitle']);
        unset($_SESSION['postDescription']);
        unset($_SESSION['postImg']);
        unset($_SESSION['postMsg']);

        //Redirect to diagram
        if(isset($_COOKIE['redirect'])) {
          if ($_COOKIE['redirect'] == 'true') {
              header('Location: '.BASE_URL.'/visual');
          }
          else {
            // redirect to detail page for that story
            header('Location: '.BASE_URL.'/news/'.$_SESSION['editID']); exit();
          }
        }
        else {
          // redirect to detail page for that story
          header('Location: '.BASE_URL.'/news/'.$_SESSION['editID']); exit();
        }

    } else {
        $_SESSION['postTitle'] = $title;
        $_SESSION['postDescription'] = $description;
        $_SESSION['postImg'] = $img_url;
        //If the form is succesfully validated
        $_SESSION['postMsg'] = "Please fill in all fields";
    }

  }
  /**
  * This function is used to get the needed information from the post and add the article
  * to the database and logs the event
  **/
  public function addProcess() {
    // get form data
    $title = $_POST['title'];
    $club = $_POST['clubs'];
    $description = $_POST['description'];
    $img_url = $_POST['img'];
    $notify = 0;
    if (isset($_POST['update'])) {
        $notify = 1;
    }

    if (!empty($title) && !empty($description)) {
        // save new NewsStory to database
        $story = new NewsStory();
        $story->title = $title;
        $story->club = $club;
        $story->description = $description;
        $story->img_url = $img_url;
        $story->notify = $notify;
        $story->author = $_SESSION['loggedInUserName'];
        $story->author_id = $_SESSION['loggedInUserID'];
        $story = NewsStory::insertStory($story);

        // log the event
        $ev = new Event();
        $ev->event_type = Event::EVENT_TYPE['add_story'];
        $ev->user_id = $story['author_id'];
        $ev->story_id = $story['id'];
        $ev = Event::insertEvent($ev);

        //Remove the session variables after form has been succesfully submitted
        unset($_SESSION['postTitle']);
        unset($_SESSION['postDescription']);
        unset($_SESSION['postImg']);
        unset($_SESSION['postMsg']);

        //Redirect to diagram
        if(isset($_COOKIE['redirect'])) {
          if ($_COOKIE['redirect'] == 'true') {
              header('Location: '.BASE_URL.'/visual');
          }
          else {
              header('Location: '.BASE_URL.'/news/'.$story['id']); exit();
          }
        }
        else {
            header('Location: '.BASE_URL.'/news/'.$story['id']); exit();
        }

    } else {
        $_SESSION['postTitle'] = $title;
        $_SESSION['postDescription'] = $description;
        $_SESSION['postImg'] = $img_url;
        //If the form is succesfully validated
        $_SESSION['postMsg'] = "Please fill in all fields";
        // redirect to detail page for that story
        header('Location: '.BASE_URL.'/postArticle'); exit();
    }
  }

  /**
  * This function is used to get the needed information from the post and add the article
  * to the database and logs the event
  **/
  public function deleteProcess() {
        $articleID = $_GET['storyID'];
        $story = NewsStory::deleteStory($articleID);
        // log the event
        $ev = new Event();
        $ev->event_type = Event::EVENT_TYPE['delete_story'];
        $ev->user_id = $_SESSION['loggedInUserID'];
        $ev = Event::insertEvent($ev);
        $ev = Event::deleteAllEventsForArticle($articleID);
        //Redirect to diagram
        if(isset($_COOKIE['redirect'])) {
          if ($_COOKIE['redirect'] == 'true') {
              header('Location: '.BASE_URL.'/visual');
          }
          else {
            // redirect to detail page for that story
            header('Location: '.BASE_URL.'/home'); exit();
          }
        }
        else {
          // redirect to detail page for that story
          header('Location: '.BASE_URL.'/home'); exit();
        }        
  }

  /**
  * This function is used to control what the user sees in the detailed view of a single article
  * on the webserver
  **/
  public function detail() {
    $storyID = $_GET['storyID'];
    $article = NewsStory::loadByID($storyID);

    $pageTitle = 'News Article';
    include_once SYSTEM_PATH.'/view/header.php';
    include_once SYSTEM_PATH.'/view/detail.php';
    include_once SYSTEM_PATH.'/view/footer.php';
  }

  /**
  * This function is used to control what a logged in user sees when he goes to the mange articles
  * tab
  **/
  public function manage() {
    $username = $_SESSION['loggedInUserName'];
    $articles = NewsStory::loadAllStoriesForUser($username);
    $pageTitle = 'Manage Articles';
    include_once SYSTEM_PATH.'/view/header.php';
    include_once SYSTEM_PATH.'/view/manageArticles.php';
    include_once SYSTEM_PATH.'/view/footer.php';
  }

}
