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
<?php include (SHARED_PATH . '/staff_header.php'); ?>

<table class="table table-bordered table-responsive-md table-striped text-center">
    <tr>
        <th class="text-center">Name</th>
        <th class="text-center">Photos</th>
        <th class="text-center">Created at</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach ($photos as $photo) { ?>
    <tr>
        <td class="text-center"><?php echo h($photo->name); ?></td>
        <td class="d-lg-table-cell img-thumbnail"><?php echo '<img src="data:image; base64,' . h(base64_encode($photo->image)) . '"'; ?></td>
        <td class="text-center"><?php echo h($photo->created_at); ?></td>
    </tr>
    <?php } ?>
</table>

<?php include (SHARED_PATH . '/staff_footer.php'); ?>