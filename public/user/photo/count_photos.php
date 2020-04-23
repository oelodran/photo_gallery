<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 23.5.2019.
 * Time: 10:46
 */
require_once("../../../private/initialize.php");

$folder_path = PUBLIC_PATH . '/images';
$count_file = (count(scandir($folder_path)) - 2);

?>
<div class="mb-3">There are exactly <strong class="alert-danger"><?php echo $count_file; ?></strong> photographs.</div>
