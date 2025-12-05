<?php

/**
 * Entité représentant un livre.
 * Avec les champs id, pseudo, content, et idArticle.
 */
 
class MessageManager extends AbstractEntityManager
{
    public function getMessagesByDiscussion(int $discussion_id): array
    {
        $sql = "SELECT * FROM messages WHERE discussion_id = :discussion_id";
        $stmt = $this->db->query($sql, ['discussion_id' => $discussion_id]);
        $messages = [];
        while ($message = $stmt->fetch()) {
            $messages[] = new Message($message);
        }
        return $messages;
    }

    public function addMessage(int $discussion_id, int $user_id, string $content): void
    {
        $sql = "INSERT INTO messages (discussion_id, user_id, content) VALUES (:discussion_id, :user_id, :content)";
        $this->db->query($sql, ['discussion_id' => $discussion_id, 'user_id' => $user_id, 'content' => $content]);
    }
 
}   
    
