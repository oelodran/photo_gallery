<?php

require_once ('../../../private/initialize.php');

// prevent this code from being loaded directly in the browser
// or without first setting the necessary object
if (!isset($user))
{
    redirect_to(url_for('/user/users/index.php'));
}

?>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" aria-describedby="username" name="user[username]"
                   value="<?php echo h($user->username); ?>"placeholder="Enter username">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user[email]"
                   value="<?php echo h($user->email); ?>" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="InputPassword1" name="user[password]" value="" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="InputConfirmPassword1">Confirm Password</label>
            <input type="password" class="form-control" id="InputConfirmPassword1" name="user[confirm_password]" value="" placeholder="Confirm Password">
        </div>

<!--        <button type="submit" class="btn btn-primary">Submit</button>-->