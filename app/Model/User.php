<?php

namespace App\Model;

class User extends Model
{
    public function __construct(
        public ?string $name = null,
        public ?string $username = null,
        public ?string $password = null,
    ) {
        parent::__construct();
    }

    public function save()
    {
        $stmt = $this->db->prepare('INSERT INTO users (name, username, password) VALUES (?,?,?)');
        $stmt->execute([
            $this->name, $this->username, password_hash($this->password, PASSWORD_BCRYPT)
        ]);
        return true;
    }

    public function find_by_username(string $username)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function find_by_id(string $id)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
