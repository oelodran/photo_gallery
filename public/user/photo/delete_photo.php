<?php require_once("../../../private/initialize.php"); ?>

<?php require_login(); ?>

<?php
	// must have an ID
  if(empty($_GET['id']))
  {
      $session->message("No photograph ID was provided.");
      redirect_to('index.php');
  }

  $photo = Photo::find_by_id($_GET['id']);
  $user = User::find_by_id($photo->user_id);
  $photo->upload_dir = $user->username;

  if($photo && $photo->destroy())
  {
      $session->message("The photo {$photo->filename} was deleted.");
      redirect_to(url_for('/user/users/management.php?id=' . h(u($photo->user_id))));
  }
  else
  {
      $session->message("The photo could not be deleted.");
      redirect_to(url_for('/user/users/management.php?id=' . h(u($photo->user_id))));
  }
  
?>

