<?php

/**
 * Entité représentant un livre.
 * Avec les champs id, pseudo, content, et idArticle.
 */
 
class Discussion extends AbstractEntity 
{
    protected int $id;
    protected ?int $user_1_id; // always lower id
    protected ?int $user_2_id; // always higher id
    protected int $new_messages_count_user_1;
    protected int $new_messages_count_user_2;

    // ------------------------------------------

    protected ?string $request_user_picture;
    protected string $request_user_pseudo;

    protected ?string $last_message_content;
    protected ?int $last_message_user_id;
    protected ?DateTime $last_message_at;


    function displayImage() : string
    {
        if ($this->getRequestUserPicture() === null) {
            return '<img src="' . 'uploads/default.png' . '" alt="Photo de profil de ' . $this->getRequestUserPseudo() . '">';
        }
        
        return '<img src="' . $this->getRequestUserPicture() . '" >';
    }
    
    public function getOtherUserId($userId): int
    {
        if ($this->getUser1Id() === $userId) {
            return $this->getUser2Id();
        }
        return $this->getUser1Id();
    }

    public function getFormatLastMessageAt(): string
    {
        if ($this->getLastMessageAt() === null) {
            return '';
        }

        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Europe/Paris'));
        $interval = $now->diff($this->getLastMessageAt());
        
        if ($interval->y > 0) {
            return $this->getLastMessageAt()->format('d.m.Y');
        }
        
        if ($interval->m > 0) {
            return $this->getLastMessageAt()->format('d.m');
        }
        
        return $this->getLastMessageAt()->format('H:i');
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
    public function getLastMessageContent(): ?string 
    {
        return $this->last_message_content;
    }

    /**
     * Setter pour le titre.
     * @param int $last_message_id
     * @return void
     */
    public function setLastMessageContent(?string $last_message_content): void 
    {
        $this->last_message_content = $last_message_content;
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

    public function getRequestUserPicture(): ?string 
    {
        return $this->request_user_picture;
    }

    public function setRequestUserPicture(?string $request_user_picture): void 
    {
        $this->request_user_picture = $request_user_picture;
    }

    public function getRequestUserPseudo(): ?string 
    {
        return $this->request_user_pseudo;
    }

    public function setRequestUserPseudo(?string $request_user_pseudo): void 
    {
        $this->request_user_pseudo = $request_user_pseudo;
    }

    public function getLastMessageAt(): ?DateTime 
    {
        return $this->last_message_at;
    }

    public function setLastMessageAt(?string $last_message_at): void 
    {
        if ($last_message_at === null) {
            $this->last_message_at = null;
            return;
        }
        $date = new DateTime($last_message_at);
        $date->setTimezone(new DateTimeZone('Europe/Paris'));
        $this->last_message_at = $date;
    }

    public function getNewMessagesCountUser1(): int 
    {
        return $this->new_messages_count_user_1;
    }

    public function setNewMessagesCountUser1(int $new_messages_count_user_1): void 
    {
        $this->new_messages_count_user_1 = $new_messages_count_user_1;
    }

    public function getNewMessagesCountUser2(): int 
    {
        return $this->new_messages_count_user_2;
    }

    public function setNewMessagesCountUser2(int $new_messages_count_user_2): void 
    {
        $this->new_messages_count_user_2 = $new_messages_count_user_2;
    }

    public function getNewMessagesCount($userId): int 
    {
        if ($userId === $this->getUser1Id()) {
            return $this->getNewMessagesCountUser1();
        }
        return $this->getNewMessagesCountUser2();
    }

    public function setNewMessagesCount(int $new_messages_count, $userId): void 
    {
        if ($userId === $this->getUser1Id()) {
            $this->setNewMessagesCountUser1($new_messages_count);
            return;
        }
        $this->setNewMessagesCountUser2($new_messages_count);
    }
      
    public function getLastMessageUserId(): ?int 
    {
        return $this->last_message_user_id;
    }

    public function setLastMessageUserId(?int $last_message_user_id): void 
    {
        $this->last_message_user_id = $last_message_user_id;
    }
}   
    
