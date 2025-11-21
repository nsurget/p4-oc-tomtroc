<?php


class HomeController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome(): void
    {
        $bookController = new BookController();
        $recentBooks = $bookController->getRecentBooks();


        $view = new View("Page d'accueil");
        $view->render("home", [
            'recentBooks' => $recentBooks
        ]);
    }
}