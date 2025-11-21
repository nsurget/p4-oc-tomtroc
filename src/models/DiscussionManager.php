<?php

/**
 * Entité représentant un livre.
 * Avec les champs id, pseudo, content, et idArticle.
 */
 
class DiscussionManager extends AbstractEntityManager 
{
    
    public function getDiscussionsByUser(int $user_id): array 
    {
        $sql= "SELECT * FROM discussions WHERE user_id = :user_id";
        $stmt = $this->db->query($sql, ['user_id' => $user_id]);
        $discussions = [];
        while ($discussion = $stmt->fetch()) {
            $discussions[] = new Discussion($discussion);
        }

        return $discussions;
    }
    
}   
    
