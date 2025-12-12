<?php

/**
 * Entité représentant un livre.
 * Avec les champs id, title, description, availability, url_image, author_id, user_id.
 */

class Book extends AbstractEntity
{
    protected int $id;
    protected string $title;
    protected string $description;
    protected string $availability;
    protected ?string $url_image;
    protected int $author_id;

    protected string $author_name;
    protected int $user_id;

    protected string $user_pseudo;


    public function displayImage()
    {
        if ($this->getUrlImage() == null) {
            return '<img src="./uploads/default.png" alt="' . $this->getTitle() . '">';
        }

        return '<img src="' . $this->getUrlImage() . '" alt="' . $this->getTitle() . '">';
    }


    // GETTER & SETTER Complémentaires

    public function getAuthorName()
    {
        return $this->author_name;
    }

    public function setAuthorName(string $author_name): void
    {
        $this->author_name = $author_name;
    }


    public function getUserPseudo()
    {
        return $this->user_pseudo;
    }

    public function setUserPseudo(string $user_pseudo): void
    {
        $this->user_pseudo = $user_pseudo;
    }



    // --- GETTER & SETTER

    /**
     * Getter pour l'id.
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Setter pour l'id.
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter pour le titre.
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter pour la description.
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Setter pour la description.
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Getter pour la disponibilité.
     * @return string
     */
    public function getAvailability(): string
    {
        return $this->availability;
    }

    
    public function displayAvailability(): string
    {
        if ($this->availability == "available") {
            return '<span class="color-green">Disponible</span>';
        }
        return '<span class="color-red">Indisponible</span>';
    }
    

    /**
     * Setter pour la disponibilité. 
     * @param string $availability
     * @return void
     */
    public function setAvailability(string $availability): void
    {
        $this->availability = $availability;
    }

    public function getUrlImage(): string|null
    {
        return $this->url_image;
    }

    public function setUrlImage(?string $url_image): void
    {
        $this->url_image = $url_image;
    }

    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    public function setAuthorId(int $author_id): void
    {
        $this->author_id = $author_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

}

