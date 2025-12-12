<?php

class BookController 
{
    public function showBooks(): void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooksAvailable();

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
        $id = intval($id);
        if (empty($id)) {
            Utils::redirect(AppRoutes::SHOW_BOOKS);
        }

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
        $id = intval($id);
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

        $user_id = $_SESSION['idUser'];
        $author_name = Utils::request('author_name');
        $author_name = htmlspecialchars($author_name);
        $authorManager = new AuthorManager();
        $author_id = $authorManager->getAuthorIdByName($author_name);
        
        if ($author_id == 0) {
            $author_id = $authorManager->addAuthor($author_name);
        }

        $bookUrl = Utils::request("url-picture");
        $bookUrl = htmlspecialchars($bookUrl);
        if (empty($bookUrl)) {
            $bookPicture = $_FILES['upload-picture'];
            $bookUrl = Utils::uploadFile($bookPicture);
        }

        
        
        
        $id = Utils::request('id');
        $id = intval($id);
        $title = Utils::request('title');
        $title = htmlspecialchars($title);
        $description = Utils::request('description');
        $description = htmlspecialchars($description);
        $availability = Utils::request('availability');
        
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        $book->setId($id);
        $book->setTitle($title);
        $book->setAuthorId($author_id);
        $book->setUserId($user_id);
        $book->setDescription($description);
        $book->setAvailability($availability);
        $book->setUrlImage($bookUrl);

        
        $id = $bookManager->saveBook($book);
        Utils::redirect(AppRoutes::SHOW_SINGLE_BOOK , ['id' => $id]);
    }
    
    public function deleteBook(): void
    {
        Utils::checkUserConnected();
        
        $id = Utils::request('id');
        $id = intval($id);
        
        $bookManager = new BookManager();
        $bookManager->deleteBook($id);
        
        Utils::redirect(AppRoutes::USER_PROFIL);
    }
}