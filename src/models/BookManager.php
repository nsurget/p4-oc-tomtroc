<?php

/**
 * Cette classe sert à gérer les commentaires. 
 */
class BookManager extends AbstractEntityManager
{
    public function getAllBooks(): array
    {
        $sql = "SELECT 
                    books.*, 
                    authors.name AS author_name,
                    users.pseudo AS user_pseudo 
                FROM books 
                INNER JOIN authors ON books.author_id = authors.id 
                INNER JOIN users ON books.user_id = users.id;";

        $result = $this->db->query($sql);

        $books = [];

        while ($book = $result->fetch()) {

            $books[] = new Book($book);

        }
        return $books;
    }

    public function getBooksBySearch(string $search): array
    {
        $sql = "SELECT 
                    books.*, 
                    authors.name AS author_name,
                    users.pseudo AS user_pseudo 
                FROM books 
                INNER JOIN authors ON books.author_id = authors.id 
                INNER JOIN users ON books.user_id = users.id 
                WHERE books.title LIKE :search OR authors.name LIKE :search OR users.pseudo LIKE :search;";

        $result = $this->db->query($sql, ['search' => "%$search%"]);

        $books = [];

        while ($book = $result->fetch()) {

            $books[] = new Book($book);

        }
        return $books;
    }

    public function getBooksByUser(int $id): array
    {
        $sql = "SELECT 
                    books.*, 
                    authors.name AS author_name,
                    users.pseudo AS user_pseudo 
                FROM books 
                INNER JOIN authors ON books.author_id = authors.id 
                INNER JOIN users ON books.user_id = users.id 
                WHERE books.user_id = :id;";

        $result = $this->db->query($sql, ['id' => $id]);

        $books = [];

        while ($book = $result->fetch()) {

            $books[] = new Book($book);

        }
        return $books;
    }

    public function getBookById(int $id): ?Book
    {
        $sql = "SELECT 
                    books.*, 
                    authors.name AS author_name,
                    users.pseudo AS user_pseudo 
                FROM books 
                INNER JOIN authors ON books.author_id = authors.id 
                INNER JOIN users ON books.user_id = users.id 
                WHERE books.id = :id;";

        $result = $this->db->query($sql, ['id' => $id]);

        $book = $result->fetch();

        if ($book) {
            return new Book($book);
        }
        return new Book();
    }

    public function getRecentBooks(int $limit = 4): array
    {
        if ($limit < 1) {
            throw new Exception("Le nombre de livres doit être supérieur ou égal à 1.");
        }

        if (!is_int($limit)) {
            throw new Exception("Le nombre de livres doit être un entier.");
        }

        $sql = "SELECT 
                    books.*, 
                    authors.name AS author_name,
                    users.pseudo AS user_pseudo
                FROM books 
                INNER JOIN authors ON books.author_id = authors.id 
                INNER JOIN users ON books.user_id = users.id 
                ORDER BY books.created_at DESC 
                LIMIT " . $limit . ";";

        $result = $this->db->query($sql);

        $books = [];

        while ($book = $result->fetch()) {

            $books[] = new Book($book);

        }
        return $books;
    }

    public function saveBook(Book $book): int
    {
        
        if ($book->getId() == null) {
            $sql = "INSERT INTO books (title, author_id, user_id, description, availability) VALUES (:title, :author_id, :user_id, :description, :availability);";
        } else {
            $sql = "UPDATE books SET title = :title, author_id = :author_id, user_id = :user_id, description = :description, availability = :availability WHERE id = :id;";
        }

        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'author_id' => $book->getAuthorId(),
            'user_id' => $book->getUserId(),
            'description' => $book->getDescription(),
            'availability' => $book->getAvailability(),
            'id' => $book->getId()
        ]);

        $book_id = $this->db->lastInsertId();
        return $book_id;
    }
}
