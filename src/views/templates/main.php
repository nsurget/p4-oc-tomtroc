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
                    <a href="index.php?action=<?php echo AppRoutes::HOME; ?>" <?php echo Utils::request('action',AppRoutes::HOME) === AppRoutes::HOME ? 'class="active"' : ''; ?>>Accueil</a>
                    <a href="index.php?action=<?php echo AppRoutes::SHOW_BOOKS; ?>" <?php echo Utils::request('action') === AppRoutes::SHOW_BOOKS ? 'class="active"' : ''; ?>>Nos livres à l'échange </a>
                </div>
                <div class="right-side">
                    <?php if (Utils::isUserConnected()): ?>
                        <a href="index.php?action=<?php echo AppRoutes::SHOW_DISCUSSION; ?>">Messagerie</a>
                        <a href="index.php?action=<?php echo AppRoutes::USER_PROFILE; ?>">Mon compte</a>
                        <a href="index.php?action=<?php echo AppRoutes::LOGOUT; ?>">Se deconnecter</a>
                    <?php else: ?>
                        <a href="index.php?action=<?php echo AppRoutes::LOGIN_FORM; ?>" <?php echo Utils::request('action') === AppRoutes::LOGIN_FORM ? 'class="active"' : ''; ?>>Se connecter</a>
                        <a href="index.php?action=<?php echo AppRoutes::REGISTER_FORM; ?>" <?php echo Utils::request('action') === AppRoutes::REGISTER_FORM ? 'class="active"' : ''; ?>>S'inscrire</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>

    <footer>
        <a href="index.php?action=<?php echo AppRoutes::POLICY; ?>">Politique de confidentialité</a>
        <a href="index.php?action=<?php echo AppRoutes::MENTIONS; ?>">Mentions légales</a>
        <a href="index.php?action=<?php echo AppRoutes::HOME; ?>">Tom Troc©</a>
        <img src="./uploads/footer-logo.svg" alt="Logo">
    </footer>
    <script src="./js/script.js"></script>
</body>

</html>