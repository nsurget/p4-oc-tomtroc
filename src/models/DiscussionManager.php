<?php

/**
 * Entité représentant un livre.
 * Avec les champs id, pseudo, content, et idArticle.
 */

class DiscussionManager extends AbstractEntityManager
{

    public function getDiscussionsByUser(int $user_id): array
    {
        // We use subqueries in the SELECT clause to fetch the latest message content and date.
        // Ideally, for performance on huge tables, the 'messages' table should have an index on (discussion_id, created_at).
        $sql = "
        SELECT 
            d.*, 
            u.pseudo AS request_user_pseudo, 
            u.profil_picture AS request_user_picture,
            
            -- Subquery to get the content of the very last message for this discussion
            (SELECT m.content 
             FROM messages m 
             WHERE m.discussion_id = d.id 
             ORDER BY m.created_at DESC 
             LIMIT 1
            ) AS last_message_content,

            -- Subquery to get the user id of the very last message
            (SELECT m.user_id 
             FROM messages m 
             WHERE m.discussion_id = d.id 
             ORDER BY m.created_at DESC 
             LIMIT 1
            ) AS last_message_user_id,

            -- Subquery to get the date of the very last message
            (SELECT m.created_at 
             FROM messages m 
             WHERE m.discussion_id = d.id 
             ORDER BY m.created_at DESC 
             LIMIT 1
            ) AS last_message_at

        FROM discussions d
        INNER JOIN users u ON (
            (d.user_1_id = :user_id AND d.user_2_id = u.id)
            OR 
            (d.user_2_id = :user_id AND d.user_1_id = u.id)
        )
        WHERE d.user_1_id = :user_id OR d.user_2_id = :user_id
        
        -- Sort by the alias calculated above to show active conversations first
        ORDER BY last_message_at DESC
    ";

        $stmt = $this->db->query($sql, ['user_id' => $user_id]);

        $discussions = [];
        while ($row = $stmt->fetch()) {
            $discussions[] = new Discussion($row);
        }

        return $discussions;
    }

    public function setNewMessagesCountUser1(int $discussion_id, int $new_messages_count_user_1): void
    {
        $sql = "UPDATE discussions SET new_messages_count_user_1 = :new_messages_count_user_1 WHERE id = :discussion_id";
        $this->db->query($sql, ['discussion_id' => $discussion_id, 'new_messages_count_user_1' => $new_messages_count_user_1]);
    }

    public function setNewMessagesCountUser2(int $discussion_id, int $new_messages_count_user_2): void
    {
        $sql = "UPDATE discussions SET new_messages_count_user_2 = :new_messages_count_user_2 WHERE id = :discussion_id";
        $this->db->query($sql, ['discussion_id' => $discussion_id, 'new_messages_count_user_2' => $new_messages_count_user_2]);
    }

    public function getDiscussionById(int $user_1_id, int $user_2_id): ?Discussion
    {
        $sql = "SELECT * FROM discussions WHERE (user_1_id = :user_1_id AND user_2_id = :user_2_id) OR (user_2_id = :user_1_id AND user_1_id = :user_2_id)";
        $stmt = $this->db->query($sql, ['user_1_id' => $user_1_id, 'user_2_id' => $user_2_id]);
        $row = $stmt->fetch();
        return $row ? new Discussion($row) : null;
    }

    public function addOneNewMessagesCount(Discussion $discussion, int $user_id): void
    {
        if ($user_id === $discussion->getUser1Id()) {
            $this->addOneNewMessagesCountUser1($discussion->getId());
            return;
        }
        $this->addOneNewMessagesCountUser2($discussion->getId());
    }

    public function resetNewMessagesCount(Discussion $discussion, int $user_id): void
    {
        if ($user_id === $discussion->getUser1Id()) {
            $this->setNewMessagesCountUser1($discussion->getId(), 0);
            return;
        }
        $this->setNewMessagesCountUser2($discussion->getId(), 0);
    }

    public function addOneNewMessagesCountUser1(int $discussion_id): void
    {
        $sql = "UPDATE discussions SET new_messages_count_user_1 = new_messages_count_user_1 + 1 WHERE id = :discussion_id";
        $this->db->query($sql, ['discussion_id' => $discussion_id]);
    }

    public function addOneNewMessagesCountUser2(int $discussion_id): void
    {
        $sql = "UPDATE discussions SET new_messages_count_user_2 = new_messages_count_user_2 + 1 WHERE id = :discussion_id";
        $this->db->query($sql, ['discussion_id' => $discussion_id]);
    }

    public function addDiscussion(int $user_1_id, int $user_2_id): Discussion
    {
        $sql = "INSERT INTO discussions (user_1_id, user_2_id) VALUES (:user_1_id, :user_2_id)";
        $this->db->query($sql, ['user_1_id' => $user_1_id, 'user_2_id' => $user_2_id]);
        $discussion_id = $this->db->lastInsertId();
        $discussion = $this->getDiscussionById($user_1_id, $user_2_id);
        return $discussion;
    }

    public function getNewMessagesCountByUser(int $user_id): int
    {
        // SQL query using CASE to condition which column to sum
        $sql = "SELECT SUM(
                CASE 
                    WHEN user_1_id = :user_id THEN new_messages_count_user_1
                    WHEN user_2_id = :user_id THEN new_messages_count_user_2
                    ELSE 0 
                END
            ) AS total_new_messages 
            FROM discussions 
            WHERE user_1_id = :user_id OR user_2_id = :user_id";

        $stmt = $this->db->query($sql, ['user_id' => $user_id]);
        $row = $stmt->fetch();

        // Cast result to int because SUM returns null if no rows match
        return (int) $row['total_new_messages'];
    }

}

