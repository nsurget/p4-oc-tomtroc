<?php

/**
 * Entité représentant un livre.
 * Avec les champs id, pseudo, content, et idArticle.
 */
 
class Author extends AbstractEntity 
{
    protected int $id;
    protected string $name;
    

    public function getId(): int {
        return $this->id;
    }
    
    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function setName(string $name): void {
        $this->name = $name;
    }
      
}   
    
