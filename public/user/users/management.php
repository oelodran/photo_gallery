
<?php require_once("../../../private/initialize.php"); ?>
<?php require_login(); ?>
<?php
// Find all the photos
$photos = Photo::find_all();
$id = $_GET['id'];
$user_owner = User::find_by_id($id);

if ($user_owner == false)
{
    redirect_to(url_for('/index.php'));
}
?>
<?php include (SHARED_PATH . '/user_header.php'); ?>

<h1 class="container">Photographs</h1>

<table class="table">
    <tr>
        <th>Image</th>
        <th>Caption</th>
        <th>Username</th>
        <th>Email</th>
        <th>Filename</th>
        <th>Size</th>
        <th>Type</th>
        <th>Created_at</th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach($photos as $photo) { ?>
        <?php
            $user = User::find_by_id($photo->user_id);
        ?>
        <tr>
            <td><img src="../../<?php echo $photo->image_path(); ?>" width="100" /></td>
            <td><?php echo $photo->caption; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $photo->filename; ?></td>
            <td><?php echo $photo->size_of_image(); ?></td>
            <td><?php echo $photo->type; ?></td>
            <td><?php echo $photo->created_at; ?></td>
            <?php if ($user_owner->id == $photo->user_id) { ?>
                <td><a href="<?php echo url_for('/user/photo/delete_photo.php?id=' .
                        h(u($photo->id))); ?>" class="btn btn-danger">Remove</a></td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>
<br />
<a class="btn btn-outline-dark" href="<?php echo url_for('/user/photo/photo_upload.php?id=' . h(u($user_owner->id))); ?>">Upload a new photograph</a>

<?php include (SHARED_PATH . '/user_footer.php'); ?>
