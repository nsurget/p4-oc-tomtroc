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

}