<?php

/**
* Class that represents an article on the web-server
**/
class NewsStory {
  public $id;
  public $title;
  public $author;
  public $club;
  public $img_url;
  public $date_created;
  public $description;
  public $notify;
  public $comments;
  public $likes;
  public $dislikes;
  public $author_id;

  //Name of the mySQL table that contains the article information
  const DB_TABLE = 'articles';

  /**
  * Function that generates an associative array containing all the articles
  **/
  public static function loadAllStories() {
    $query =  "SELECT * FROM ".self::DB_TABLE." ORDER BY date DESC";
    $result = mysqli_query($GLOBALS['conn'], $query);
    //Fetch data into an associative array
    $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $articles;
  }

  /**
  * Function that generates an associative array containing all the articles for a specific user
  **/
  public static function loadAllStoriesForUser($username) {
    $query =  "SELECT * FROM ".self::DB_TABLE."
              WHERE author='".$username."'
              ORDER BY date DESC";
    $query = sprintf("SELECT * FROM %s WHERE author = '%s' ORDER BY date DESC",
              self::DB_TABLE, $username);
    $result = mysqli_query($GLOBALS['conn'], $query);
    //Fetch data into an associative array
    $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $articles;
  }

  /**
  * Function that returns an associative array containing a single article related to the id specified
  * in the parameter
  */
  public static function loadByID($id) {
    //Create a query
    $query =  sprintf("SELECT * FROM %s WHERE id = %d", self::DB_TABLE, $id);
    $result = mysqli_query($GLOBALS['conn'], $query);
    //Fetch data into an associative array
    $article = mysqli_fetch_assoc($result);
    return $article;
  }

  /**
  * Function that is used to insert a new article to the mySQL Databse
  **/
  public static function insertStory($story) {
    $query = sprintf("INSERT INTO %s(title, club, img, author, body, notify, author_id, comments, likes, dislikes)
      VALUES ('%s', '%s', '%s', '%s', '%s', %d, %d, %d, %d, %d) ",
      self::DB_TABLE,
      $GLOBALS['conn']->real_escape_string($story->title),
      $GLOBALS['conn']->real_escape_string($story->club),
      $GLOBALS['conn']->real_escape_string($story->img_url),
      $story->author,
      $GLOBALS['conn']->real_escape_string($story->description),
      $story->notify,
      $story->author_id,
      $story->comments,
      $story->likes,
      $story->dislikes
      );
    mysqli_query($GLOBALS['conn'], $query);
    $storyID = $GLOBALS['conn']->insert_id;
    $ns = self::loadByID($storyID);
    return $ns;
  }

  /**
  * Function that is used to update an existing article in the mySQL Database
  **/
  public static function updateStory($id, $story) {
    $query = sprintf("UPDATE %s SET
      title = '%s', club = '%s', img = '%s', body = '%s', notify = %d
      WHERE id = $id",
      self::DB_TABLE,
      $GLOBALS['conn']->real_escape_string($story->title),
      $GLOBALS['conn']->real_escape_string($story->club),
      $GLOBALS['conn']->real_escape_string($story->img_url),
      $GLOBALS['conn']->real_escape_string($story->description),
      $story->notify
      );
    mysqli_query($GLOBALS['conn'], $query);
  }

  /**
  * Function that is used to update an existing article in the mySQL Database
  **/
  public static function deleteStory($id) {
    $query = sprintf("DELETE FROM %s WHERE id = %d", self::DB_TABLE, $id);
    mysqli_query($GLOBALS['conn'], $query);
  }

  /**
  * Function that is used to remove all articles posted by a user
  **/
  public static function deleteAllArticlesForUser($id){
    $query = sprintf("DELETE FROM %s WHERE author_id = %d", self::DB_TABLE, $id);
    mysqli_query($GLOBALS['conn'], $query);
  }

  /**
  * This function is used to filter the articles list by club and return an associative array
  * with the corresponding club
  **/
  public static function filterByClub($club) {
    $query =  sprintf("SELECT * FROM %s WHERE club = '%s'", self::DB_TABLE, $club);
    $result = mysqli_query($GLOBALS['conn'], $query);
    //Fetch data into an associative array
    $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $articles;
  }

}
