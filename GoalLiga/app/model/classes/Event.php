<?php

//Class that represents an event on the web-server
class Event
{
    //The public variables of a class
    public $id;
    public $event_type;
    public $user_id;
    public $story_id;
    public $date_created;

    //Name of the mySQL table that contains the events
    const DB_TABLE = 'events';

    //Associative array containing the type of events and the numeric value that is associated with each type
    const EVENT_TYPE = array(
    'add_story' => 1,
    'update_story' => 2,
    'delete_story' => 3,
    'new_user' => 11,
    'make_admin' => 12
    );

    /**
    * Function that returns an associative array containing all the events in the database
    **/
    public static function loadAllEvents()
    {
        $query = "SELECT * FROM ".self::DB_TABLE." ORDER BY date_created DESC";
        $result = mysqli_query($GLOBALS['conn'], $query);
        $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $events;
    }

    /**
    * Function that returns an associative array that contains all the events associated to
    * a particular user
    **/
    public static function loadAllEventsForUser($user_id) {
      $query = "SELECT * FROM ".self::DB_TABLE." WHERE user_id = $user_id ORDER BY date_created DESC";
      $result = mysqli_query($GLOBALS['conn'], $query);
      $events = mysqli_fetch_all($result, MYSQLI_ASSOC);

      return $events;
    }

    /**
    * Helper function that is used to check for null values before inserting into a SQL database
    **/
    private static function checkIfNull($val) {
      if($val == null) {
        return 'NULL';
      } elseif(is_numeric($val)) {
        return $val;
      } else {
        "'".$val."'";
      }
    }

    /**
    * Function that is used to insert an event to the mySQL database
    **/
    public static function insertEvent($event)
    {
      $query = sprintf("INSERT INTO %s(event_type, user_id, story_id)
        VALUES (%d, %d, %d) ",
        self::DB_TABLE,
        $GLOBALS['conn']->real_escape_string($event->event_type),
        $GLOBALS['conn']->real_escape_string($event->user_id),
        self::checkIfNull($GLOBALS['conn']->real_escape_string($event->story_id))
        );
      //  echo $query;
      mysqli_query($GLOBALS['conn'], $query);
    }

    /**
    * Deletes all events associated to a particular user
    **/
    public static function deleteAllEventsForUser($id) {
      $query = sprintf("DELETE FROM %s WHERE user_id = %d", self::DB_TABLE, $id);
      mysqli_query($GLOBALS['conn'], $query);
    }

    /**
    * Deletes all events relevant to a particular article ID when the article
    * is deleted from the databse
    **/
    public static function deleteAllEventsForArticle($id) {
      $query = sprintf("DELETE FROM %s WHERE story_id = %d", self::DB_TABLE, $id);
      mysqli_query($GLOBALS['conn'], $query);
    }

}
