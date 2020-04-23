<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 6.3.2019.
 * Time: 11:24
 */

class User extends DatabaseObject
{
    static protected $table_name = 'users';
    static protected $db_columns = ['id', 'username', 'email', 'hashed_password'];

    public $id;
    public $username;
    public $email;
    protected $hashed_password;
    public $password;
    public $confirm_password;
    protected $password_required = true;

    public function __construct($args = [])
    {
        $this->username = $args['username'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
    }

    protected function set_hashed_password()
    {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function verify_password($password)
    {
        return password_verify($password, $this->hashed_password);
    }

    protected function create()
    {
        $this->set_hashed_password();
        return parent::create();
    }

    protected function update()
    {
        if ($this->password != '')
        {
            // validate password
            $this->set_hashed_password();
        }
        else
        {
            // Skip validation
            $this->password_required = false;
        }
        return parent::update();
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        } elseif (!has_length($this->email, array('max' => 255))) {
            $this->errors[] = "Last name must be less than 255 characters.";
        } elseif (!has_valid_email_format($this->email)) {
            $this->errors[] = "Email must be a valid format.";
        }

        if (is_blank($this->username)) {
            $this->errors[] = "Username cannot be blank.";
        } elseif (!has_length($this->username, array('min' => 3, 'max' => 255))) {
            $this->errors[] = "Username must be between 3 and 255 characters.";
        } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
            $this->errors[] = "Username not allowed. Try another.";
        }

        if ($this->password_required)
        {
            if (is_blank($this->password)) {
                $this->errors[] = "Password cannot be blank.";
            } elseif (!has_length($this->password, array('min' => 9))) {
                $this->errors[] = "Password must contain 9 or more characters";
            } elseif (!preg_match('/[A-Z]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 uppercase letter";
            } elseif (!preg_match('/[a-z]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 lowercase letter";
            } elseif (!preg_match('/[0-9]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 number";
            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 symbol";
            }

            if (is_blank($this->confirm_password)) {
                $this->errors[] = "Confirm password cannot be blank.";
            } elseif ($this->password !== $this->confirm_password) {
                $this->errors[] = "Password and confirm password must match.";
            }
        }

        return $this->errors;
    }

    static public function find_by_username($username)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE username='" . self::$database->escape_string($username) ."'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array))
        {
            return array_shift($obj_array);
        }
        else
        {
            return false;
        }
    }
}