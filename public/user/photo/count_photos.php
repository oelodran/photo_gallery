<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 23.5.2019.
 * Time: 10:46
 */
require_once("../../../private/initialize.php");

$folder_path = PUBLIC_PATH . '/images';
//$count_file = (count(scandir($folder_path)) - 2);


// Initialize the counter variable to 0
$count_file = 0;

if( $handle = opendir($folder_path) ) {

    while( ($file = readdir($handle)) !== false ) {
        if( !in_array($file, array('.', '..')) && !is_dir($folder_path.$file))
            $count_file++;
    }
}

?>
<div class="mb-3">There are exactly <strong class="alert-danger"><?php echo $count_file; ?></strong> photographs.</div>
