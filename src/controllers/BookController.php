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
}