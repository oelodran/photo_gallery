<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 24.2.2018.
 * Time: 19:07
 */

require_once ('../../../private/initialize.php');

if (is_post_request())
{
    // Create record using post parameters
    $args = $_POST['user'];
    $user = new User($args);
    $result = $user->save();

    if ($result === true)
    {
        $new_id = $user->id;
        // make new dir for storage photos of this user
        mkdir(PUBLIC_PATH . '/images/' . $user->username);
        $session->message('The admin was created successfully.');
        redirect_to(url_for('/user/users/index.php?id=' . h($new_id)));
    }
    else
    {
        // Show errors

    }
}
else
{
    // display the form
    $user = new User();
}

?>

<?php $page_title = 'Registration'; ?>
<?php include (SHARED_PATH . '/public_header.php'); ?>

<div class="container pt-3">

    <div class="container">
        <h2 class="text-center p-3">Registration</h2>

        <?php echo display_errors($user->errors); ?>

        <form action="<?php echo url_for('/user/users/new.php'); ?>" method="post">

            <?php include ('form_fields.php'); ?>

            <div class="container pb-5">
                <input class="btn btn-primary" role="button" type="submit" value="Submit" />
            </div>
        </form>
    </div>

</div>

<?php include (SHARED_PATH . '/public_footer.php'); ?>
