<?php

class Database {
    private static $instance;
    private $connection;

    private function __construct() {
        try {
            $host = "db";
            $dbname = "entrevista";
            $user = "root";
            $password = "1234";

            $this->connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function prepare($query) {
        return $this->connection->prepare($query);
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }
}

?>
