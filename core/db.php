<?php
class Db {
    private $mysqli;
    private $logFile;

    public function __construct($host, $username, $password, $database, $logFile = 'sql_log.txt') {
        // Initialize mysqli connection
        $this->mysqli = new mysqli($host, $username, $password, $database);
        
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        // Set the log file
        $this->logFile = $logFile;
    }

    // Query method with logging
    public function query($sql) {
        $this->logSQL($sql);
        return $this->mysqli->query($sql);
    }

    // Prepare method with logging
    public function prepare($sql) {
        $this->logSQL($sql);
        return $this->mysqli->prepare($sql);
    }

    // Log SQL queries to file
    private function logSQL($sql) {
        $logEntry = "[" . date('Y-m-d H:i:s') . "] " . $sql . PHP_EOL;
        file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }

    // Close the connection
    public function close() {
        $this->mysqli->close();
    }

    // Proxy methods to access mysqli properties and methods
    public function __get($name) {
        return $this->mysqli->$name;
    }

    public function __call($name, $arguments) {
        return call_user_func_array([$this->mysqli, $name], $arguments);
    }
}
?>