<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 6.3.2019.
 * Time: 11:24
 */

class User
{
    public $id;
    public $username;
    public $email;
    protected $hashed_password;
    public $password;
    public $confirm_password;
    protected $password_require = true;

    public function __construct($args=[])
    {
        $this->username = $args['username'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
    }
}