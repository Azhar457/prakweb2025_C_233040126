<?php

class User_model
{
    private $table = "users";
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllUser() {
        $query = $this->db->query('SELECT * FROM ' . $this->table);
        return $query->resultSet();
    }

    public function getUserById($id) {
        $this->db->query(' SELECT * FROM ' . $this->table . ' WHERE id = ' . $id);
        $this->db->bind('id',$id);
        return $this->db->single();
    }
}
