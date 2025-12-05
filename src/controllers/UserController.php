<?php

class UserController 
{
    
    public function displayConnectionForm()
    {
        $view = new View("Connexion");
        $view->render("loginForm");
    }

    public function displayRegistrationForm()
    {
        $view = new View("Inscription");
        $view->render("registerForm");
    }

    public function connectUser()
    {
        // On récupère les données du formulaire.
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            throw new Exception("Le mot de passe est incorrect");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page d'accueil.
        Utils::redirect(AppRoutes::HOME);
    }

    public function registerUser()
    {
        // On récupère les données du formulaire.
        $pseudo = Utils::request("pseudo");
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($pseudo) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que l'utilisateur n'existe pas.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if ($user) {
            throw new Exception("L'utilisateur demandé existe déjà.");
        }

        // On enregistre l'utilisateur.
        $userManager->registerUser($pseudo, $email, $password);

        // On connecte l'utilisateur.
        $this->connectUser();

        // On redirige vers la page d'accueil.
        Utils::redirect(AppRoutes::HOME);
    }

    public function disconnectUser()
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);
        unset($_SESSION['idUser']);

        // On redirige vers la page d'accueil.
        Utils::redirect(AppRoutes::HOME);
    }

    public function showUserProfile()
    {
        Utils::checkUserConnected();

        $userManager = new UserManager();
        $user = $userManager->getUserById($_SESSION['idUser']);

        $bookManager = new BookManager();
        $books = $bookManager->getBooksByUser($user->getId());


        $view = new View("Profil");
        $view->render("userProfile", ['user' => $user, 'books' => $books]);
    }

    public function editUser()
    {
        Utils::checkUserConnected();

        $pseudo = Utils::request("pseudo");
        $email = Utils::request("email");
        $password = Utils::request("password");

        $userManager = new UserManager();
        $userManager->editUser($pseudo, $email, $password);

        $user = $userManager->getUserById($_SESSION['idUser']);
        if (!empty($pseudo)) {
            $user->setPseudo($pseudo);
        }
        if (!empty($email)) {
            $user->setEmail($email);
        }
        if (!empty($password)) {
            $user->setPassword($password);
        }
        $_SESSION['user'] = $user;      
        Utils::redirect(AppRoutes::USER_PROFILE);
    }

    public function editUserPicture() {
        Utils::checkUserConnected();

        $id = Utils::request("id");
        $profilUrl = Utils::request("profil-url");
        if (empty($profilUrl)) {
            $profilPicture = $_FILES['profil-picture'];
            
            $profilUrl = Utils::uploadFile($profilPicture);
        }
            

        $userManager = new UserManager();
        $userManager->editUserPicture($profilUrl, $id);
        



        Utils::redirect(AppRoutes::USER_PROFILE);
    }

}