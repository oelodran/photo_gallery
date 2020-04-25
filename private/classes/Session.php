<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 16.5.2019.
 * Time: 13:04
 */

class Session
{
    private $user_id;
    public $username;
    private $last_login;

    public const MAX_LOGIN_AGE = 60 * 60 * 24; // one day

    public function __construct()
    {
        session_start();
        $this->check_stored_login();
    }

    public function login($user)
    {
        if ($user)
        {
            // prevent session fixation attacks
            session_regenerate_id();
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->username = $_SESSION['username'] = $user->username;
            $this->last_login = $_SESSION['last_login'] = time();
        }
        return true;
    }

    public function is_logged_in()
    {
//        return isset($this->user_id);
        return isset($this->user_id) && $this->last_login_is_recent();
    }

    public function decrypt_cookie($value)
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

    public function is_remember_me()
    {

            if (isset($_COOKIE["rememberme"]))
            {
                $value = $_COOKIE["rememberme"];

                $decrypted_string = $this->decrypt_cookie($value);

                echo $decrypted_string . '<br>';

                $user = User::find_by_username($decrypted_string);
                print_r($user);
                if (!empty($user))
                {
                    $this->login($user);
                    redirect_to(url_for('user/users/index.php?id=' . u(h($user->id))));
                }
            }

    }

    public function logout()
    {
        if (isset($_COOKIE['rememberme']))
        {
            setcookie("rememberme","", time() - 3600);
        }
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['last_login']);
        unset($this->user_id);
        unset($this->username);
        unset($this->last_login);
        return true;
    }

    private function check_stored_login()
    {
        if (isset($_SESSION['user_id']))
        {
            $this->user_id = $_SESSION['user_id'];
            $this->username = $_SESSION['username'];
            $this->last_login = $_SESSION['last_login'];
        }
    }

    private function last_login_is_recent()
    {
        if (!isset($this->last_login))
        {
            return false;
        }
        elseif(($this->last_login + self::MAX_LOGIN_AGE) < time())
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function message($msg="")
    {
        if (!empty($msg))
        {
            // set message
            $_SESSION['message'] = $msg;
            return true;
        }
        else
        {
            // get message
            return $_SESSION['message'] ?? '';
        }
    }

    public function clear_message()
    {
        unset($_SESSION['message']);
    }
}