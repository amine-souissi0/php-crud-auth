<?php

namespace Models;

use Core\Database;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    // Fetch all users
    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Additional methods (e.g., create, findByEmail, etc.)
    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO users (nom, prenom, email, phone, pays, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssss",
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['phone'],
            $data['pays'],
            password_hash($data['password'], PASSWORD_DEFAULT)
        );

        return $stmt->execute();
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
