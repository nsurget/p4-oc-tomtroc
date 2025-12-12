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
        $email = htmlspecialchars($email);
        $password = Utils::request("password");
        $password = htmlspecialchars($password);

        // On vérifie que les données sont valides.
        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if (!$user) {
            throw new Exception("L'Email ou le mot de passe est incorrect");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            throw new Exception("L'Email ou le mot de passe est incorrect");
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
        $pseudo = htmlspecialchars($pseudo);
        $email = Utils::request("email");
        $email = htmlspecialchars($email);
        $password = Utils::request("password");
        $password = htmlspecialchars($password);

        // On vérifie que les données sont valides.
        if (empty($pseudo) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que l'utilisateur n'existe pas.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if ($user) {
            throw new Exception("Un utilisateur avec cette adresse email existe déjà.");
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

    public function showUserProfil()
    {
        Utils::checkUserConnected();

        $userManager = new UserManager();
        $user = $userManager->getUserById($_SESSION['idUser']);

        $bookManager = new BookManager();
        $books = $bookManager->getBooksByUser($user->getId());


        $view = new View("Profil");
        $view->render("userProfil", ['user' => $user, 'books' => $books]);
    }

    public function showPublicUserProfil($id)
    {
        $userManager = new UserManager();
        $user = $userManager->getUserById($id);

        $bookManager = new BookManager();
        $books = $bookManager->getBooksByUser($user->getId());

        $view = new View("Profil de". $user->getPseudo());
        $view->render("userPublicProfil", ['user' => $user, 'books' => $books]);

    }


    public function editUser()
    {
        Utils::checkUserConnected();

        $pseudo = Utils::request("pseudo");
        $pseudo = htmlspecialchars($pseudo);
        $email = Utils::request("email");
        $email = htmlspecialchars($email);
        $password = Utils::request("password");
        $password = htmlspecialchars($password);

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
        Utils::redirect(AppRoutes::USER_PROFIL);
    }


    public function editUserPicture() {
        Utils::checkUserConnected();

        $id = Utils::request("id");
        $id = intval($id);
        $profilUrl = Utils::request("profil-url");
        $profilUrl = htmlspecialchars($profilUrl);
        
        if (empty($profilUrl)) {
            $profilPicture = $_FILES['profil-picture'];
            
            $profilUrl = Utils::uploadFile($profilPicture);
        }
            

        $userManager = new UserManager();
        $userManager->editUserPicture($profilUrl, $id);
        



        Utils::redirect(AppRoutes::USER_PROFIL);
    }

}