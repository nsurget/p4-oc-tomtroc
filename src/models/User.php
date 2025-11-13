<?php

/**
 * Entité User : un user est défini par son id, un login et un password.
 */ 
class User extends AbstractEntity 
{
    private string $pseudo;
    private string $password;
    private string $email;
    private ?string $profil_picture = null;

     public function displayImage() : string
    {
        if ($this->getProfilPicture() === null) {
            return '<img src="' . 'uploads/default.png' . '" alt="' . $this->getPseudo() . '">';
        }

        return '<img src="' . $this->getProfilPicture() . '" alt="' . $this->getPseudo() . '">';
    }


    // --- GETTER & SETTER

    /**
     * Setter pour le pseudo.
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo) : void 
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Getter pour le pseudo.
     * @return string
     */
    public function getPseudo() : string 
    {
        return $this->pseudo;
    }

    /**
     * Setter pour le password.
     * @param string $password
     */
    public function setPassword(string $password) : void 
    {
        $this->password = $password;
    }

    /**
     * Getter pour le password.
     * @return string
     */
    public function getPassword() : string 
    {
        return $this->password;
    }

    /**
     * Setter pour l'email.
     * @param string $email
     */
    public function setEmail(string $email) : void 
    {
        $this->email = $email;
    }

    /**
     * Getter pour l'email.
     * @return string
     */
    public function getEmail() : string 
    {
        return $this->email;
    }

    /**
     * Setter pour le profil_picture.
     * @param string $profil_picture
     */
    public function setProfilPicture(?string $profil_picture) : void 
    {
        $this->profil_picture = $profil_picture;
    }

    /**
     * Getter pour le profil_picture.
     * @return string
     */
    public function getProfilPicture(): string|null
    {
        return $this->profil_picture;
    }
}