<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 24.2.2018.
 * Time: 19:50
 */
require_once ('../../../private/initialize.php');

require_login();

if (!isset($_GET['id']))
{
    redirect_to(url_for('/user/users/delete.php'));
}
$id = $_GET['id'];
$user = User::find_by_id($id);
if ($user == false)
{
    redirect_to(url_for('/user/users/index.php'));
}

if (is_post_request())
{
    // save record using post parameters
    $args = $_POST['user'];
    $user->merge_attributes($args);
    $result = $user->save();

    if ($result === true)
    {
        $session->message('The admin was updated successfully.');
        redirect_to(url_for('/user/users/index.php?id=' . $id));
    }
    else
    {
        // show errors
        echo 'Something went wrong.';
    }
}
else
{
    // display the form

}

?>


<?php $page_title = 'Edit user'; ?>
<?php include (SHARED_PATH . '/user_header.php'); ?>

    <div class="container pt-3">

        <div class="container">
            <h2 class="text-center p-3">Edit User</h2>

                    <?php echo display_errors($user->errors); ?>

            <form action="<?php echo url_for('/user/users/edit.php?id=' . h(u($id))); ?>" method="post">

                <?php include ('form_fields.php'); ?>

                <div class="container pb-5">
                    <input class="btn btn-primary" role="button" type="submit" value="Edit" />
                </div>
            </form>
        </div>

    </div>

<?php include (SHARED_PATH . '/user_footer.php'); ?>