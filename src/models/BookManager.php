<?php

/**
 * Cette classe sert à gérer les commentaires. 
 */
class BookManager extends AbstractEntityManager
{
    public function getAllBooks(): array
    {
        $sql = "SELECT * FROM books;";

        $result = $this->db->query($sql);

        $books = [];

        while ($book = $result->fetch()) {

            $books[] = new Book($book);

        }
        return $books;
    }
}
