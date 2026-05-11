<?php
/**
 * Database Connection Handler
 */

class Database {
    private static $instance = null;
    private $connection;
    private $charset = 'utf8mb4';

    private function __construct() {
        try {
            $this->connection = new mysqli(
                DB_HOST,
                DB_USER,
                DB_PASS,
                DB_NAME
            );

            if ($this->connection->connect_error) {
                throw new Exception('Database connection failed: ' . $this->connection->connect_error);
            }

            $this->connection->set_charset($this->charset);
        } catch (Exception $e) {
            error_log($e->getMessage());
            die('Database connection error. Please try again later.');
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function query($sql) {
        $result = $this->connection->query($sql);
        if (!$result) {
            error_log('Query error: ' . $this->connection->error);
            return false;
        }
        return $result;
    }

    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }

    public function escape($string) {
        return $this->connection->real_escape_string($string);
    }

    public function close() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}

// Initialize database connection
$db = Database::getInstance()->getConnection();
