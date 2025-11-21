<?php

/**
 * Entité représentant un livre.
 * Avec les champs id, pseudo, content, et idArticle.
 */
 
class Discussion extends AbstractEntity 
{
    protected int $id;
    protected ?int $last_message_id;
    protected ?int $user_1_id;
    protected ?int $user_2_id;
    

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
    public function getLastMessageId(): int 
    {
        return $this->last_message_id;
    }

    /**
     * Setter pour le titre.
     * @param int $last_message_id
     * @return void
     */
    public function setLastMessageId(int $last_message_id): void 
    {
        $this->last_message_id = $last_message_id;
    }

    public function getUser1Id(): int 
    {
        return $this->user_1_id;
    }

    public function setUser1Id(int $user_1_id): void 
    {
        $this->user_1_id = $user_1_id;
    }

    public function getUser2Id(): int 
    {
        return $this->user_2_id;
    }

    public function setUser2Id(int $user_2_id): void 
    {
        $this->user_2_id = $user_2_id;
    }
      
}   
    
