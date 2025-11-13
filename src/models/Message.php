<?php

/**
 * Entité représentant un livre.
 * Avec les champs id, pseudo, content, et idArticle.
 */
 
class Message extends AbstractEntity 
{
    protected int $id;
    protected string $content;
    protected int $user_id;
    
    protected int $discustion_id;
    
    protected ?string $book_id;
    protected ?DateTime $created_at;

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
    
    public function getContent(): string {
        return $this->content;
    }
    
    public function setContent(string $content): void {
        $this->content = $content;
    }
    
    public function getUserId(): int {
        return $this->user_id;
    }
    
    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }
    
    public function getDiscustionId(): int {
        return $this->discustion_id;
    }
    
    public function setDiscustionId(int $discustion_id): void {
        $this->discustion_id = $discustion_id;
    }
    
    public function getBookId(): ?string {
        return $this->book_id;
    }
    
    public function setBookId(?string $book_id): void {
        $this->book_id = $book_id;
    }
    
    public function getCreatedAt(): ?DateTime {
        return $this->created_at;
    }
    
    public function setCreatedAt(?DateTime $created_at): void {
        $this->created_at = $created_at;
    }     
}   
    
