<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 6.3.2019.
 * Time: 17:30
 */
function db_connect()
{
    try {
        $connection = new PDO(DSN, DB_USER, DB_PASS);
        return $connection;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

function db_disconnect($connection)
{
    if (isset($connection)) {
        $connection = null;
    }
}