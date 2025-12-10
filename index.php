<?php


require_once 'config/autoload.php';
require_once 'config/config.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action');





// Try catch global pour gérer les erreurs
try {
    // If no action is defined in the URL parameters
    if (!$action) {
        // Get the current path requested by the user
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Check if the user is strictly at the root or index.php
        if ($path === '/' || $path === '/index.php') {
            $action = AppRoutes::HOME;
        } else {
            Utils::redirect(AppRoutes::EMPTY);
        }
    }
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
            $search = Utils::request('search');


            if (!empty($search)) {
                $search = htmlspecialchars($search);
                $bookController->showSearchBooks($search);
            } else {
                $bookController->showBooks();
            }
            break;

        case AppRoutes::USER_PROFIL:
            $userController = new UserController();
            $id = Utils::request('id');
            if (empty($id) || !empty($_SESSION['idUser']) && $_SESSION['idUser'] == $id) {
                $userController->showUserProfil();
            } else {
                $userController->showPublicUserProfil($id);
            }
            break;

        case AppRoutes::USER_EDIT:
            $userController = new UserController();
            $userController->editUser();
            break;

        case AppRoutes::USER_EDIT_PICTURE:
            $userController = new UserController();
            $userController->editUserPicture();
            break;

        case AppRoutes::SHOW_SINGLE_BOOK:
            $bookController = new BookController();
            $bookController->showBook();
            break;

        case AppRoutes::SHOW_DISCUSSION:
            $discussionController = new DiscussionController();
            $discussionController->showDiscussion();
            break;

        case AppRoutes::ADD_BOOK_FORM:
            $bookController = new BookController();
            $bookController->addBookForm();
            break;

        case AppRoutes::EDIT_BOOK_FORM:
            $bookController = new BookController();
            $bookController->editBookForm();
            break;

        case AppRoutes::SAVE_BOOK:
            $bookController = new BookController();
            $bookController->saveBook();
            break;

        case AppRoutes::SEND_MESSAGE:
            $discussionController = new DiscussionController();
            $discussionController->sendMessage();
            break;

        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
