<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 5.3.2019.
 * Time: 12:57
 */
require_once ('../private/initialize.php');

$session->is_remember_me();

include (SHARED_PATH . '/public_header.php');

// $photos = Photo::find_all();
// Use pagination instead
$current_page = $_GET['page'] ?? 1;
$per_page = 3;
$total_count = Photo::count_all();

$pagination = new Pagination($current_page, $per_page, $total_count);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$photos = Photo::find_by_sql($sql);
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
            <?php
            $user = User::find_by_id($photo->user_id);
            $photo->upload_dir = $user->username;
            ?>
            <div class="col-md-4">
                <div class="img-thumbnail">
                    <a href="images/<?php echo $photo->image_path(); ?>">
                        <img class="img-thumbnail" src="images/<?php echo $photo->image_path(); ?>">
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

<?php

$url = url_for('/index.php');
echo $pagination->page_links($url);

?>

<?php include (SHARED_PATH . '/public_footer.php'); ?>