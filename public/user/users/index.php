<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 9.5.2019.
 * Time: 12:21
 */

require_once ('../../../private/initialize.php');

require_login();

//$users = User::find_all();
$id = $_GET['id'] ?? '';

$user = User::find_by_id($id);
?>

<?php include(SHARED_PATH . '/user_header.php'); ?>

<!--<table class="table table-light table-responsive-md table-hover mt-4">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Username</th>
            <th class="text-center">Email</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>

<?php /*foreach ($users as $user) { */?>
    <tr>
        <td class="text-center"><?php /*echo h($user->id)*/?></td>
        <td class="text-center"><?php /*echo h($user->username)*/?></td>
        <td class="text-center"><?php /*echo h($user->email)*/?></td>
        <td><a class="btn btn-outline-dark" role="button" href="<?php /*echo
            url_for('/user/users/index.php?id=' . h(u($user->id))); */?>">View</a></td>
        <td><a class="btn btn-outline-dark" role="button" href="<?php /*echo
            url_for('/user/users/edit.php?id=' . h(u($user->id))); */?>">Edit</a></td>
        <td><a class="btn btn-outline-dark" role="button" href="<?php /*echo
            url_for('/user/users/delete.php?id=' . h(u($user->id))); */?>">Delete</a></td>
    </tr>
<?php /*} */?>
</table>-->
<h1>Welcome <?php echo h($user->username); ?></h1>


<?php include(SHARED_PATH . '/user_footer.php'); ?>
