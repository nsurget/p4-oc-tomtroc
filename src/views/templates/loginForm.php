<section class="register-login-form">
    <div class="left-side">
        <h1>Connexion</h1>
        <form action="index.php?action=loginProcess" method="post">
            <label for="email">Email </label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe </label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="btn btn-primary">Se connecter</button>
            <p>Pas de compte ? <a href="index.php?action=<?php echo AppRoutes::REGISTER_FORM; ?>">Inscrivez-vous</a></p>
        </form>
    </div>
    <div class="right-side">
        <img src="./uploads/login-register.png" alt="bibliotheque avec plusieurs livres empilés">
    </div>
</section>