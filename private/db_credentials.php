<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 6.3.2019.
 * Time: 17:00
 */

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "leon");
define("DB_NAME", "shared_gallery");

$dsn = 'mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME;

define("DSN", $dsn);
