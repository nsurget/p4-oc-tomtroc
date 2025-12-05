<?php

class BookController 
{
    public function showBooks(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();

        $view = new View("Nos livres à l'échange");
        $view->render("books", ['books' => $books]);
    }

    public function showSearchBooks(string $search): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getBooksBySearch($search);

        $view = new View("Résultats pour '$search'");
        $view->render("books", ['books' => $books, 'search' => $search]);
    }

    
    public function showBook(): void
    {
        $id = Utils::request('id');
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        $userManager = new UserManager();
        $user = $userManager->getUserById($book->getUserId());

        $view = new View("Livre");
        $view->render("singleBook", ['book' => $book, 'user' => $user]);
    }

    public function getRecentBooks(): array
    {
        $bookManager = new BookManager();
        return $bookManager->getRecentBooks();
    }

    public function addBookForm(): void
    {
        Utils::checkUserConnected();

        $authorManager = new AuthorManager();
        $authors = $authorManager->getAllAuthors();

        $view = new View("Ajouter un livre");
        $view->render("editBookForm", ['authors' => $authors]);
    }

    public function editBookForm(): void
    {
        Utils::checkUserConnected();
        $id = Utils::request('id');
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);

        $authorManager = new AuthorManager();
        $authors = $authorManager->getAllAuthors();

        $view = new View("Ajouter un livre");
        $view->render("editBookForm", ['book' => $book, 'authors' => $authors]);
    }

    public function saveBook(): void
    {
        Utils::checkUserConnected();
        
        $user_id = $_SESSION['user_id'];
        
        $author_name = Utils::request('author_name');
        $authorManager = new AuthorManager();
        $author_id = $authorManager->getAuthorIdByName($author_name);
        if ($author_id === null) {
            $author_id = $authorManager->addAuthor($author_name);
        }
        
        
        
        $id = Utils::request('id');
        $title = Utils::request('title');
        $description = Utils::request('description');
        $availability = Utils::request('availability');
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        $book->setTitle($title);
        $book->setAuthorId($author_id);
        $book->setUserId($user_id);
        $book->setDescription($description);
        $book->setAvailability($availability);

        
        $bookManager->saveBook($book);

        Utils::redirect(AppRoutes::SHOW_SINGLE_BOOK , ['id' => $id]);
    }
}