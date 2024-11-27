<?php

namespace Core;

use mysqli;

class Database
{
    private $host = 'localhost';
    private $user = 'noauthuser';
    private $password = '';
    private $database = 'webminds1';
    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
