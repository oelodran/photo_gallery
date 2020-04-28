<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/user/users/index.php'));
}
$id = $_GET['id'];
$user = User::find_by_id($id);
if($user == false) {
    redirect_to(url_for('/user/users/index.php'));
}

if(is_post_request()) {

    // Delete user
    $result = $user->delete();
    if ($result)
    {
        $files = glob(PUBLIC_PATH . '/images/' . $user->username . '/*');
        foreach ($files as $file)
        {
            if (is_file($file))
            {
                unlink($file);
            }
        }

        rmdir(PUBLIC_PATH . '/images/' . $user->username);
    }
    $session->message('The user was deleted successfully.');
    redirect_to(url_for('/index.php'));

} else {
    // Display form
}

?>

<?php $page_title = 'Delete User'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

    <div class="container mt-3">
        <h2 class="text-center pb-3">Delete User</h2>
        <p class="ml-5">Are you sure you want to delete your account?</p>
        <p class="ml-5 mb-5 h5"><?php echo h($user->username); ?></p>

        <form action="<?php echo url_for('/user/users/delete.php?id=' . h(u($id))); ?>" method="post">
            <div class="container">
                <input class="btn btn-primary" type="submit" name="commit" value="Delete" />
            </div>
        </form>
    </div>

<?php include(SHARED_PATH . '/user_footer.php'); ?>
