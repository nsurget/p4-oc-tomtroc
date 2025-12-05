<section class="single-book">
    <div class="book-picture">
        <?= $book->displayImage() ?>
    </div>
    <div class="book-info">
        <h2><?= $book->getTitle() ?></h2>
        <p><?= $book->getAuthorName() ?></p>
        <p>Description : </p>
        <p><?= $book->getDescription() ?></p>
        <p>Propriétaire : </p>
        <div class="user">
            <p><?= $user->displayImage() ?></p>
            <p><?= $user->getPseudo() ?></p>

        </div>
        <? if (!empty($_SESSION['idUser']) && $_SESSION['idUser'] != $user->getId()): ?>
            <a href="?action=<?= AppRoutes::SHOW_DISCUSSION ?>&id=<?= $user->getId() ?>">Envoyer un message</a>
        <? endif; ?>
    </div>

</section>