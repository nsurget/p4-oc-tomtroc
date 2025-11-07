<?php

/**
 * Entité représentant un livre.
 * Avec les champs id, pseudo, content, et idArticle.
 */
 
class Book extends AbstractEntity 
{
    protected int $id;
    protected string $title;
    protected string $description;
    protected string $availability;
    protected string $url_image;
    protected int $author_id;
    protected int $user_id;
    
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

    /**
     * Setter pour la disponibilité. 
     * @param string $availability
     * @return void
     */
    public function setAvailability(string $availability): void 
    {
        $this->availability = $availability;
    }

    public function getUrlImage(): string 
    {
        return $this->url_image;
    }

    public function setUrlImage(string $url_image): void 
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
    
