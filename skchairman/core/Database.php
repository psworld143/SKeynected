<?php

class Database
{
    private static ?PDO $instance = null;

    private function __construct() {}
    private function __clone() {}

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $config = require dirname(__DIR__) . '/config/config.php';
            $dbConfig = $config['database'];

            // Create DSN with host, database name, and charset
            $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";

            try {
                // Pass the username and password from the configuration
                self::$instance = new PDO($dsn, $dbConfig['username'], $dbConfig['password']); // Ensure password is included
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die('Connection failed: ' . htmlspecialchars($e->getMessage()));
            }
        }

        return self::$instance;
    }
}
