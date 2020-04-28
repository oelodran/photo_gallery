<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 8.3.2019.
 * Time: 9:32
 */

class Photo extends DatabaseObject
{
    static protected $table_name = "photos";
    static protected $db_columns = ['id', 'user_id', 'filename', 'type', 'size', 'caption', 'created_at'];

    public $id;
    public $user_id;
    public $filename;
    public $type;
    public $size;
    public $caption;
    public $created_at;

    private $temp_path;
    public $upload_dir = "";
    public $errors = [];

    protected $upload_errors = [
        UPLOAD_ERR_OK => "No errors.",
        UPLOAD_ERR_INI_SIZE => "Large then upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "Large then form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL => "Partial upload.",
        UPLOAD_ERR_NO_FILE => "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION => "File upload stopped by extension."
    ];

    // Pass in $_FILE['upload_file'] as an argument
    public function attach_file($file)
    {
        if (!$file || empty($file) || !is_array($file))
            // Nothing uploaded or wrong argument usage
        {
            $this->errors[] = "No file was uploaded.";
            return false;
        }
        elseif ($file['error'] != 0)
        {
            // error report: what is wrong
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        }
        else
        {
            $this->temp_path  = $file['tmp_name'];
            $this->filename = basename($file['name']) ?? '';
            $this->type = $file['type'] ?? '';
            $this->size = $file['size'] ?? '';
            return true;
        }
    }

    public function save()
    {
        // A new function won't have an id yet
        if (isset($this->id))
        {
            $this->update();
        }
        else
        {
            // Can't save if there are errors
            if (!empty($this->errors)) { return false; }

            // Make sure the caption is not too long for the DB
            if(strlen($this->caption) > 255) {
                $this->errors[] = "The caption can only be 255 characters long.";
                return false;
            }

            // Can't save without filename and temp location
            if (empty($this->filename) || empty($this->temp_path))
            {
                $this->errors[] = "The file location was not available.";
                return false;
            }

            // Determine the target path
            $target_path = PUBLIC_PATH . "/images/" . $this->upload_dir . "/" . $this->filename;

            // Check if file already exists
            if (file_exists($target_path))
            {
                $this->errors = "This file {$this->filename} already exists.";
                return false;
            }

            // Attempt to move the file
            if (move_uploaded_file($this->temp_path, $target_path))
            {
                // Success
                if ($this->create())
                {
                    // Clear temp_path
                    unset($this->temp_path);
                    return true;
                }
            }
            else
            {
                // Failure
                $this->errors[] = "This file upload failed, possibly due to incorrect permissions
                on the upload folder.";
                return false;
            }
        }
    }

    public function destroy()
    {
        // First remove the database entry
        if ($this->delete())
        {
            // then remove the file
            $target_path = PUBLIC_PATH . '/images/' . $this->image_path();
            return unlink($target_path) ? true : false;
        }
        else
        {
            // Database delete failed
            return false;
        }
    }

    public function image_path()
    {
        return $this->upload_dir. '/' .$this->filename;
    }

    public function size_of_image()
    {
        if ($this->size < 1024)
        {
            return "{$this->size} bytes";
        }
        elseif ($this->size < 1048576)
        {
            $size_kb = round($this->size / 1024, 1);
            return "{$size_kb} KB";
        }
        else
        {
            $size_mb = round($this->size / 1048576, 1);
            return "{$size_mb} MB";
        }
    }
}