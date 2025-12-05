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

    public function getAllAuthors(): array
    {
        $sql = "SELECT * FROM authors;";

        $result = $this->db->query($sql);

        $authors = [];

        while ($author = $result->fetch()) {

            $authors[] = new Author($author);

        }
        return $authors;
    }

    public function getAuthorIdByName(string $name): int
    {
        $sql = "SELECT id FROM authors WHERE name = :name;";

        $result = $this->db->query($sql, ['name' => $name]);

        $author = $result->fetch();

        return $author['id'];
    }

    public function addAuthor(string $name): int
    {
        $sql = "INSERT INTO authors (name) VALUES (:name);";

        $this->db->query($sql, ['name' => $name]);

        return $this->db->lastInsertId();
    }
}
