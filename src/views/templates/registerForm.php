<section class="register-login-form">
    <div class="left-side">
        <h1>Inscription</h1>
        <form action="index.php?action=<?php echo AppRoutes::REGISTER_PROCESS; ?>" method="post">
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
            <p>Déjà inscrit ? <a href="index.php?action=<?php echo AppRoutes::LOGIN_FORM; ?>">Connectez-vous</a></p>
        </form>
    </div>
    <div class="right-side">
        <img src="./uploads/login-register.png" alt="bibliotheque avec plusieurs livres empilés">
    </div>
</section>