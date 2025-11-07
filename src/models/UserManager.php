<?php

/** 
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */

class UserManager extends AbstractEntityManager 
{
    /**
     * Récupère un user par son email.
     * @param string $email
     * @return ?User
     */
    public function getUserByEmail(string $email) : ?User 
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $result = $this->db->query($sql, ['email' => $email]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    public function registerUser(string $pseudo, string $email, string $password) : void
    {

        $password = password_hash($password, PASSWORD_DEFAULT);
        $email = strtolower($email);
        
        $sql = "INSERT INTO users (pseudo, email, password) VALUES (:pseudo, :email, :password)";
        
        $this->db->query($sql, ['pseudo' => $pseudo, 'email' => $email, 'password' => $password]);
    }
}