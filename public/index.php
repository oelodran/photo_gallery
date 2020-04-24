<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 5.3.2019.
 * Time: 12:57
 */
require_once ('../private/initialize.php');

is_remember_me();

include (SHARED_PATH . '/public_header.php');

$photos = Photo::find_all();
?>
<div class="container">
    <h1 class="text-center mb-3 mt-3">Shared Gallery</h1>

    <div class="mb-3">
        <div id="main">
            <p>How many images are there?</p>
        </div>
        <button id="ajax-button" class="btn btn-info">Count Photos</button>
    </div>

  

    <div class="row">
        <?php foreach ($photos as $photo) { ?>
            <div class="col-md-4">
                <div class="img-thumbnail">
                    <a href="<?php echo $photo->image_path(); ?>">
                        <img class="img-thumbnail" src="<?php echo $photo->image_path(); ?>">
                        <div class="figure-caption text-center">
                            <p><?php echo h($photo->caption); ?><br>
                            <?php echo h(date("d-m-Y", strtotime($photo->created_at))); ?></p>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include (SHARED_PATH . '/public_footer.php'); ?>