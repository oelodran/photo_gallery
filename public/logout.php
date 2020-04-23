<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 16.5.2019.
 * Time: 11:36
 */


require_once('../private/initialize.php');

// Log out the admin
$session->logout();

redirect_to(url_for('/login.php'));

?>