<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 5.3.2019.
 * Time: 13:54
 */

function url_for($script_path)
{
    // add the leading '/' if not present
    if ($script_path[0] != '/') {
        $script_path = '/' . $script_path;
    }
    return WWW_ROOT . $script_path;
}

function u($string="")
{
    return urlencode($string);
}

function raw_u($string="")
{
    return rawurlencode($string);
}

function h($string="")
{
    return htmlspecialchars($string);
}

function redirect_to($location)
{
    header("Location: " . $location);
}

function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function encrypt_cookie($value)
{
// Store the cipher method in variable
    $cipher = "AES-128-CTR";
// Get the cipher iv length
    $iv_length = openssl_cipher_iv_length($cipher);
    $options = 0;
    $iv = '8565825542115032';
// Take the encryption key in a variable
    $enc_key = "super_secret";
// Encrypt the data using openssl_encrypt function
    $encrypted_cookie = openssl_encrypt($value, $cipher, $enc_key, $options, $iv);
    return $encrypted_cookie;
}

function decrypt_cookie($value)
{
    // Store the cipher method in variable
    $cipher = "AES-128-CTR";
    // Get the cipher iv length
    $iv_length = openssl_cipher_iv_length($cipher);
    $options = 0;
    $decryption_iv = '8565825542115032';
// Store the decryption key
    $dec_key = "super_secret";
// Use openssl_decrypt() function to decrypt the data
    $decrypted_string=openssl_decrypt ($value, $cipher, $dec_key, $options, $decryption_iv);
    return $decrypted_string;
}

function is_remember_me()
{
    if (isset($_COOKIE["rememberme"]))
    {
        $users[] = User::find_by_username($_COOKIE["rememberme"]);
        if (!empty($users))
        {
            foreach ($users as $user)
            redirect_to(url_for('/user/users/index.php?id=' . $user->id));
        }
    }
    else
    {

    }
}