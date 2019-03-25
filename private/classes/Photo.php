<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 8.3.2019.
 * Time: 9:32
 */

class Photo
{
    // ---START OF ACTIVE RECORD CODE ---
    static protected $database;

    static public function set_database($database)
    {
        self::$database = $database;
    }

    static public function find_by_sql($sql)
    {
        $result = self::$database->query($sql);
        if (!$result) {
            exit("Database query failed.");
        }

        // results into objects
        $object_array = [];
        while ($record = $result->fetch()) {
            $object_array[] = self::instantiate($record);
        }

        $result = null;

        return $object_array;
    }

    static public function find_all()
    {
        $sql = 'SELECT * FROM photos';
        return self::find_by_sql($sql);
    }

    static public function find_by_id($id)
    {
        $sql = "SELECT * FROM photos ";
        $sql .= "WHERE id='" . self::$database->quote($id) . "'";
        $obj_array = self::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    static protected function instantiate($record)
    {
        $object = new self();

        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }

        return $object;
    }
    // ---END OF ACTIVE RECORD CODE ---

    public $id;
    public $user_id;
    public $name;
    public $image;
    public $created_at;

    private $temp_path;
    public $errors = [];

    protected $upload_errors = [
        UPLOAD_ERR_OK => "No errors.",
        UPLOAD_ERR_INI_SIZE => "Large then upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "Large then form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL => "Partial upload.",
        UPLOAD_ERR_NO_FILE => "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extension."
        ];

    public function __construct($args=[])
    {
        if (!$args || empty($args) || !is_array($args)) {
            $this->errors[] = "No file was uploaded.";
            return false;
        } elseif ($args['error'] != 0) {
            $this->errors[] = $this->upload_errors[$args['error']];
            return false;
        } else {
            $this->temp_path = $args['tmp_path'] ?? '';
            $this->user_id = $args['user_id'] ?? '';
            $this->name = basename($args['name']) ?? '';
            $this->image = $args['image'] ?? '';
        }
    }
}