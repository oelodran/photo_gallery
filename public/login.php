<?php
require_once ('../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if (is_post_request())
{
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $check = $_POST['check'] ?? '';

    // validation
    if (is_blank($username))
    {
        $errors[] = "Username cannot be blank.";
    }

    if (is_blank($password))
    {
        $errors[] = "Password cannot be blank.";
    }

    // try to login
    if (empty($errors))
    {
        $user = User::find_by_username($username);
        // test if user found and password is correct
        if ($user != false && $user->verify_password($password))
        {
            if ($check === "checked")
            {
                //$username_encrypt = encrypt_cookie($username);
                setcookie("rememberme", $username, time() + (86400 * 30), "/");
            }
            // user logged in
            $session->login($user);
            redirect_to(url_for('/user/users/index.php?id=' . h(u($user->id))));
        }
        else
        {
            // username not found or password does not match
            $errors[] = "Log in was unsuccessful.";
        }
    }

}
?>
<?php $page_title = 'Log in'; ?>
<?php include (SHARED_PATH . '/public_header.php'); ?>
    <div class="container">
        <h1 class="text-center">Log in or <a btn btn-dark href="<?php echo url_for('/user/users/new.php'); ?>">Registration</a></h1>

        <?php echo display_errors($errors); ?>

        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="username" name="username"
                       value="<?php echo h($username); ?>"placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="InputPassword1" name="password" value="" placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="Check1" name="check" value="checked">
                <label class="form-check-label" for="Check1">Remember my</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php include (SHARED_PATH . '/public_footer.php'); ?>