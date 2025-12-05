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

    public function getUserById(int $id) : ?User 
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
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

    public function editUser(string $pseudo, string $email, string $password) : void
    {

        !empty($password) ? $password = password_hash($password, PASSWORD_DEFAULT) : $password = $_SESSION['user']->getPassword();
        !empty($email) ? $email = strtolower($email) : $email = $_SESSION['user']->getEmail();
        !empty($pseudo) ?: $pseudo = $_SESSION['user']->getPseudo();

        try {
            $sql = "UPDATE users SET pseudo = :pseudo , email = :email , password = :password WHERE id = :id";
            $this->db->query($sql, ['pseudo' => $pseudo, 'email' => $email, 'password' => $password, 'id' => $_SESSION['idUser']]);
        } catch (Exception $e) {
            throw new Exception("Une erreur est survenue lors de la modification de l'utilisateur.");
        }
    }

    public function editUserPicture(string $profilPicture, int $id) : void
    {
        $sql = "UPDATE users SET profil_picture = :profil_picture WHERE id = :id";
        $this->db->query($sql, ['profil_picture' => $profilPicture, 'id' => $id]);
    }
}