
<?php require_once("../../private/initialize.php"); ?>
<?php require_login(); ?>
<?php
// Find all the photos
$photos = Photo::find_all();
?>
<?php (SHARED_PATH . '/user_header.php'); ?>

<h1 class="container">Photographs</h1>

<?php echo $_GET['id']; ?>
<table class="table">
    <tr>
        <th>Image</th>
        <th>Filename</th>
        <th>Caption</th>
        <th>Size</th>
        <th>Type</th>
        <th>Created_at</th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach($photos as $photo) { ?>
        <tr>
            <td><img src="../../<?php echo $photo->image_path(); ?>" width="100" /></td>
            <td><?php echo $photo->filename; ?></td>
            <td><?php echo $photo->caption; ?></td>
            <td><?php // echo $photo->size_as_text(); ?></td>
            <td><?php echo $photo->type; ?></td>
            <td><?php echo $photo->created_at; ?></td>
            <td><a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a></td>
        </tr>
    <?php } ?>
</table>
<br />
<a href="<?php url_for('/user/users/management.php?id=' . u($_GET['id'])); ?>">Upload a new photograph</a>

<?php (SHARED_PATH . '/user.footer.php'); ?>
