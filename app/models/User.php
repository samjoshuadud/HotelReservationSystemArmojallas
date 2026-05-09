<?php

class User extends Model {
    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM admin_users WHERE username = :u");
        $stmt->execute([':u' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
