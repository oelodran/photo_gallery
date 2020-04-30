<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 8.4.2019.
 * Time: 17:38
 */
require_once('../../../private/initialize.php');

require_login();
?>

<?php
$max_file_size = 7864320; // 7.5 MB
if (!isset($_GET['id']))
{
    redirect_to(url_for('/index.php'));
    //echo "error";
}

$id = $_GET['id'] ?? '';
$user = User::find_by_id($id);

$message = "";

if (is_post_request())
{
    //global $user;
    $user = User::find_by_id($_POST['user_id']);
    $photo = new Photo();
    $photo->upload_dir = $user->username;
    $photo->user_id = $_POST['user_id'];
    $timestamp = time();
    $photo->created_at = date('Y-m-d G:i:s', $timestamp);
    $photo->caption = $_POST['caption'];
    $photo->attach_file($_FILES['file_upload']);

    $result = $photo->save();

    if ($result === true)
    {
        $new_id = $photo->id;
        $session->message("Image uploaded successfully.");
        redirect_to(url_for('/user/users/management.php?id=' . h(u($photo->user_id))));
    }
    else
    {
        $_GET['id'] = $user->id;
        redirect_to(url_for('user/photo/photo_upload.php?id=' . $user->id));
        print_r($photo->errors);
    }
}
?>

<?php include(SHARED_PATH . '/user_header.php'); ?>

<div class="container mt-3">

    <form action="photo_upload.php" enctype="multipart/form-data" method="post" >
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
        <div class="form-group">
            <input type="file" class="form-control-file"  name="file_upload"/>
        </div>
        <div class="form-group">
            <label for="Caption">Caption</label>
            <input type="text" class="form-control" name="caption" value="" />
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name="user_id" value="<?php echo $user->id; ?>" />
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="submit" value="Upload" />
        </div>
    </form>
</div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>


