<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 5.3.2019.
 * Time: 13:08
 */
require_once ('../../private/initialize.php');

$photos = Photo::find_all();
?>

<table>
    <?php foreach ($photos as $photo) { ?>
    <tr>
        <td><?php echo h($photo->name); ?></td>
        <td><?php echo '<img src="data:image; base64,' . h(base64_encode($photo->image)) . '"'; ?></td>
        <td><?php echo h($photo->created_at); ?></td>
    </tr>
    <?php } ?>
</table>

