<?php
$book = $params['book'] ?? null;
?>

<a href="?action=<?= AppRoutes::SHOW_SINGLE_BOOK; ?>&id=<?= $book->getId(); ?>">
    <div class="book-card">
        <?= $book->displayImage() ?>
        <p class="title"><?= $book->getTitle() ?></p>
        <p class="author"><?= $book->getAuthorName() ?></p>
        <p class="seller">Vendu par : <?= $book->getUserPseudo() ?></p>
    </div>
</a>