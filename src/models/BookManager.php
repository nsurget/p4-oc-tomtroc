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

    public function getBooksByUser(int $id): array
    {
        $sql = "SELECT * FROM books WHERE user_id = :id;";

        $result = $this->db->query($sql, ['id' => $id]);

        $books = [];

        while ($book = $result->fetch()) {

            $books[] = new Book($book);

        }
        return $books;
    }

    public function getBookById(int $id): ?Book
    {
        $sql = "SELECT * FROM books WHERE id = :id;";

        $result = $this->db->query($sql, ['id' => $id]);

        $book = $result->fetch();

        if ($book) {
            return new Book($book);
        }
        return null;
    }
}
