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
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}