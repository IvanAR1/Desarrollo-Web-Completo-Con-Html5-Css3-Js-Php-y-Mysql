<?php
namespace Model;
class ActiveRecord {

    // DATABASE
    protected static $db;
    protected static $table = '';
    protected static $columns = [];

    // Alerts and Messages
    protected static $alerts = [];
    
    // Define the connection to the DB - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlert($type, $message) {
        static::$alerts[$type][] = $message;
    }

    // Validation
    public static function getAlerts() {
        return static::$alerts;
    }

    public function validate() {
        static::$alerts = [];
        return static::$alerts;
    }

    // SQL query to create an object in Memory
    public static function querySQL($query) {
        // Database query
        $response = self::$db->query($query);

        // iterate the results
        $array = [];
        while($register = $response->fetch_assoc()) {
            $array[] = static::createObject($register);
        }

        // release memory
        $response->free();

        // return the results
        return $array;
    }

    // Creates the object in memory that is equal to the one in the database
    protected static function createObject($register) {
        $object = new static;

        foreach($register as $key => $value ) {
            if(property_exists( $object, $key  )) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    // Identify and join the attributes of the DB
    public function attributes() {
        $attributes = [];
        foreach(static::$columns as $column) {
            if($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    // Sanitize the data before saving it to the DB
    public function sanitizeAttributes() {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach($attributes as $key => $value ) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    // Synchronize DB with Objects in memory
    public function sync($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registers - CRUD
    public function save() {
        if(!is_null($this->id))
        {
            return $this->update();
        }else
        {
            return $this->create();
        }
    }

    // All registers
    public static function all() {
        $query = "SELECT * FROM " . static::$table;
        $response = self::querySQL($query);
        return $response;
    }

    // Searching a register by id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$table  ." WHERE id = {$id}";
        $response = self::querySQL($query);
        return array_shift( $response );
    }

    // Searching a register by vars
    public static function where(string $param, string $operator, string $condition) {
        $query = "SELECT * FROM " . static::$table . " WHERE $param $operator '$condition'";
        //return $query;
        $response = self::querySQL($query);
        return array_shift( $response );
    }

    // Get results with a limit
    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " LIMIT {$limit}";
        $response = self::querySQL($query);
        return array_shift( $response ) ;
    }

    // Create a register
    public function create() {
        // Data Sanitized
        $attributes = $this->sanitizeAttributes();

        // Insert in the database
        $query = " INSERT INTO " . static::$table . "(";
        $query .= join(',', array_keys($attributes));
        $query .= ") VALUES ('"; 
        $query .= join("','", array_values($attributes));
        $query .= "')";


        // Query response
        $response = self::$db->query($query);
        return [
           'resultado' =>  $response,
           'id' => self::$db->insert_id
        ];
    }

    // Register update
    public function update() {
        // Data Sanitized
        $attributes = $this->sanitizeAttributes();

        // Iterate to add each field of the database
        $values = [];
        foreach($attributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        // Query SQL
        $query = "UPDATE " . static::$table ." SET ";
        $query .=  join(', ', $values );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        // Update Database
        $response = self::$db->query($query);
        return $response;
    }

    // Delete a Register by ID
    public function delete() {
        $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $response = self::$db->query($query);
        return $response;
    }

}