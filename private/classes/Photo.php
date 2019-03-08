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

    public function __construct($args=[])
    {
        $this->user_id = $args['user_id'] ?? '';
        $this->name = $args['name'] ?? '';
        $this->image = $args['image'] ?? '';
    }
}