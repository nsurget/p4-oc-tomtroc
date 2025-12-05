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
    private DateTime $created_at;
    
     public function displayImage() : string
    {
        
        if ($this->getProfilPicture() === null) {
            return '<img src="' . 'uploads/default.png' . '" alt="Photo de profil de ' . $this->getPseudo() . '">';
        }
        
        
        return '<img src="' . $this->getProfilPicture() . '" >';
    }

    public function getMemberSince() : string
    {
        $date = $this->getCreatedAt();
        $now = new DateTime();
        $diff = $now->diff($date);

        if ($diff->d > 30) {
            if ($diff->m > 12) {
                return 'Membre depuis ' . $diff->y . ' années';
            }
            return 'Membre depuis ' . $diff->m . ' mois';
        }
        return 'Membre depuis ' . $diff->d . ' jours';
    }



    // --- GETTER & SETTER

    /**
     * Setter pour l'id.
     * @param int $id
     */
    public function setCreatedAt(string $created_at) : void 
    {
        $this->created_at = new DateTime($created_at);
    }

    /**
     * Getter pour l'id.
     * @return int
     */
    public function getCreatedAt() : DateTime 
    {
        return $this->created_at;
    }

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