<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 5.3.2019.
 * Time: 12:57
 */
require_once ('../private/initialize.php');

include (SHARED_PATH . '/public_header.php');

$photos = Photo::find_all();
?>
<div class="container">
    <h1 class="text-center mb-3 mt-3">Shared Gallery</h1>
    <div class="row">
        <?php foreach ($photos as $photo) { ?>
            <div class="col-md-4">
                <div class="img-thumbnail">
                    <a href="<?php echo 'data:image/gif;base64,' . h(base64_encode($photo->image)); ?>">
                        <img src="<?php echo 'data:image/gif;base64,' . h(base64_encode($photo->image)); ?>" style="width: 100%">
                        <div class="figure-caption text-center">
                            <p><?php echo h($photo->name); ?><br>
                            <?php echo h(date("d-m-Y", strtotime($photo->created_at))); ?></p>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include (SHARED_PATH . '/public_footer.php'); ?>