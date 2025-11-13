<?php

/**
 * Cette classe sert à gérer les auteurs. 
 */
class AuthorManager extends AbstractEntityManager
{
    public function getAuthorById(int $id): Author
    {
        $sql = "SELECT * FROM authors WHERE id = :id;";

        $result = $this->db->query($sql, ['id' => $id]);

        

        $author = $result->fetch();

        return new Author($author);
    }
}
