<?php
/**
* Public class that represents a single user on the web server
**/
class User {
  public $id;
  public $username;
  public $password;
  public $role;
  public $date_registered;
  public $club;
  public $firstName;
  public $lastName;
  public $email;

  //Name of the mySQL table containing the users of the web server and their relevant
  //information
  const DB_TABLE = 'user';

  //Associative array that represents the types of users on the web server and the numeric
  //value that represents them
  const ROLE = array(
    'regular' => 0,
    'admin' => 1
    );

  /**
  * Function that generates an associative array containing all the articles
  **/
  public static function loadAllUsers() {
    $query =  "SELECT * FROM ".self::DB_TABLE." ORDER BY username ASC";
    $result = mysqli_query($GLOBALS['conn'], $query);
    //Fetch data into an associative array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $users;
  }

  /**
  * Function that is used to get an associative array of a particular user by their username
  **/
  public static function loadByUsername($username) {
    $query = sprintf("SELECT * FROM %s WHERE username = '%s'",
        self::DB_TABLE,
        $GLOBALS['conn']->real_escape_string($username)
        );
    $result = mysqli_query($GLOBALS['conn'], $query);
    //Fetch data into an associative array
    $user = mysqli_fetch_assoc($result);
    return $user;
  }

  /**
  * Function that is used to get an associative array of a particular user by their userID
  **/
  public static function loadByID($userID) {
    $query = sprintf("SELECT * FROM %s WHERE id = %d",
        self::DB_TABLE,
        $GLOBALS['conn']->real_escape_string($userID)
        );
    $result = mysqli_query($GLOBALS['conn'], $query);
    //Fetch data into an associative array
    $user = mysqli_fetch_assoc($result);
    return $user;
  }

  /**
  * Function that updates the user password
  **/
  public static function updatePassword($userID, $password) {
    $query = sprintf("UPDATE %s SET
      password = '%s'
      WHERE id = %d",
      self::DB_TABLE, $password, $userID);
    mysqli_query($GLOBALS['conn'], $query);
  }

  /**
  * Function that is  used to make a user an admin
  **/
  public static function makeAdmin($username) {
    $query = sprintf("UPDATE %s SET
      role = 1
      WHERE username = '%s'",
      self::DB_TABLE, $username);
    mysqli_query($GLOBALS['conn'], $query);
  }

  /**
  * Function that is used to delete a user by their username
  **/
  public static function deleteUser($username) {
    $query = sprintf("DELETE FROM %s WHERE username = '%s'",
        self::DB_TABLE,
        $GLOBALS['conn']->real_escape_string($username)
        );
    mysqli_query($GLOBALS['conn'], $query);
  }

  /**
  * Function that inserts a new user to the database
  **/
  public static function insertUser($user){
    $query = sprintf("INSERT INTO %s (username, password, role, favoriteClub, firstName, lastName, email) VALUES ('%s', '%s', 0, '%s', '%s', '%s', '%s')",
      self::DB_TABLE,
      $GLOBALS['conn']->real_escape_string($user->username),
      $GLOBALS['conn']->real_escape_string($user->password),
      $GLOBALS['conn']->real_escape_string($user->club),
      $GLOBALS['conn']->real_escape_string($user->firstName),
      $GLOBALS['conn']->real_escape_string($user->lastName),
      $GLOBALS['conn']->real_escape_string($user->email)
      );
    $result = $GLOBALS['conn']->query($query);
    if($result) {
      $ID = $GLOBALS['conn']->insert_id;
      $user = self::loadByID($ID);
      return $user;
    } else {
      return null;
    }
  }

}
