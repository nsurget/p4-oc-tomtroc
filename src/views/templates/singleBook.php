<section class="single-book">
    <div class="small-container single-book-container">
        <div class="book-picture">
            <?= $book->displayImage() ?>
        </div>
        <div class="book-info">
            <h2><?= $book->getTitle() ?></h2>
            <p class="author">par <?= $book->getAuthorName() ?></p>
            <div class="separator"></div>
            <p class="label">Description</p>
            <p class="description"><?= $book->getDescription() ?></p>
            <p class="label">Propriétaire</p>
            <div class="user">
                <a href="?action=<?= AppRoutes::USER_PROFIL ?>&id=<?= $user->getId() ?>">
                    <div><?= $user->displayImage() ?></div>
                    <p><?= $user->getPseudo() ?></p>
                </a>
            </div>
            <? if (!empty($_SESSION['idUser']) && $_SESSION['idUser'] != $user->getId()): ?>
                <a href="?action=<?= AppRoutes::SHOW_DISCUSSION ?>&id=<?= $user->getId() ?>" class="btn btn-primary">Envoyer un message</a>
            <? endif; ?>
        </div>
    </div>

</section>