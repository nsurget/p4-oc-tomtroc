<?php

/**
 * Entité représentant un livre.
 * Avec les champs id, pseudo, content, et idArticle.
 */
 
class Author extends AbstractEntity 
{
    protected int $id;
    protected string $lastname;
    protected string $firstname;
    

    public function getId(): int {
        return $this->id;
    }
    
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function getLastname(): string {
        return $this->lastname;
    }
    
    public function setLastname(string $lastname): void {
        $this->lastname = $lastname;
    }
    
    public function getFirstname(): string {
        return $this->firstname;
    }
    
    public function setFirstname(string $firstname): void {
        $this->firstname = $firstname;
    }
    
      
}   
    
