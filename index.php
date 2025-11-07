<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages accessibles à tous.
        case AppRoutes::HOME:
            $homeController = new HomeController();
            $homeController->showHome();
            break;

        case AppRoutes::LOGIN_FORM:
            $userController = new UserController();
            $userController->displayConnectionForm();
            break;

        case AppRoutes::REGISTER_FORM:
            $userController = new UserController();
            $userController->displayRegistrationForm();
            break;

        case AppRoutes::LOGIN_PROCESS:
            $userController = new UserController();
            $userController->connectUser();
            break;

        case AppRoutes::REGISTER_PROCESS:
            $userController = new UserController();
            $userController->registerUser();
            break;

        case AppRoutes::LOGOUT:
            $userController = new UserController();
            $userController->disconnectUser();
            break;

        case AppRoutes::SHOW_BOOKS:
            $bookController = new BookController();
            $bookController->showBooks();
            break;
            
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
