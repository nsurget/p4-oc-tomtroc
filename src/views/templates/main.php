<?php
/**
 * Template principal.
 * 
 * @var string $title
 * @var string $content
 */

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'TomTroc' ?></title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <div class="container header-container">
            <?php if (file_exists('./uploads/logo.svg')): ?>
                <div class="logo">
                    <a href="index.php?action=<?php echo AppRoutes::HOME; ?>">
                        <img src="./uploads/logo.svg" alt="Logo">
                    </a>
                </div>
            <?php endif; ?>
            <nav>
                <div class="left-side">
                    <a href="index.php?action=home" <?php echo Utils::request('action') === AppRoutes::HOME ? 'class="active"' : ''; ?>>Accueil</a>
                    <a href="index.php?action=showBooks" <?php echo Utils::request('action') === AppRoutes::SHOW_BOOKS ? 'class="active"' : ''; ?>>Nos livres à l'échange </a>
                </div>
                <div class="right-side">
                    <a href="index.php?action=loginForm" <?php echo Utils::request('action') === AppRoutes::LOGIN_FORM ? 'class="active"' : ''; ?>>Se connecter</a>
                    <a href="index.php?action=registerForm" <?php echo Utils::request('action') === AppRoutes::REGISTER_FORM ? 'class="active"' : ''; ?>>S'inscrire</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>

    <footer>

    </footer>
    <script src="./js/script.js"></script>
</body>

</html>