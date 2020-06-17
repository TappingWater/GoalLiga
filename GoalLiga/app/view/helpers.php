<?php

function showDeleteButton($userId, $authorId)
{
    $user = User::loadByID($userId);
    if ($userId == $authorId || $user['role'] == 1) {
      return true;
    }
    else {
      return false;
    }
}

function createUsernameLink($userID)
{
    $user = User::loadByID($userID);
    $formatted = $user['username'];
    return $formatted;
}

function formatEvent($ev)
{
  $type = $ev['event_type'];
  switch ($type) {
    case 1:
    // [User] has added the story, "[Title]." [Date]
    $story = NewsStory::loadByID($ev['story_id']);
    $title = $story['title'];
    $formatted = createUsernameLink($ev['user_id'])." added the story, $title";
    break;

    case 2:
      // [User] has added the story, "[Title]." [Date]
      $story = NewsStory::loadByID($ev['story_id']);
      $title = $story['title'];
      $formatted = createUsernameLink($ev['user_id'])." updated the story, $title";
      break;

    case 3:
      // [User] has deleted an existing article." [Date]
      $formatted = createUsernameLink($ev['user_id']).' has deleted an existing article';
      break;

    case 11:
      // [User] has joined Goal Liga. Welcome!." [Date]
      $formatted = createUsernameLink($ev['user_id']).' has joined Goal Liga. Welcome!.';
      break;

    case 12:
      // [User] was made an administrator." [Date]
      $formatted = createUsernameLink($ev['user_id']).' was made an administrator. ';
      break;

    default:
      $formatted = 'Unrecognized event type.';
      break;
  }
    return $formatted;
}
