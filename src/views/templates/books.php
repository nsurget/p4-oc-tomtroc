<section class="books-archive container">
    <h1>Nos livres à l'échange</h1>

    <form action="?action=<?= AppRoutes::SHOW_BOOKS; ?>" method="post">
        <input type="text" placeholder="Rechercher un livre">
        <button type="submit"></button>
    </form>


    <?php foreach ($books as $book): ?>
        <a href="?action=<?= AppRoutes::SHOW_SINGLE_BOOK; ?>&id=<?= $book->getId(); ?>">
            <div class="book">
                <div>
                    <?= $book->displayImage() ?>
                </div>
                <p><?= $book->getTitle() ?></p>
                <p><?= $book->getAuthorName() ?></p>
                <p><?= $book->getUserPseudo() ?></p>
            </div>
        </a>
    <?php endforeach; ?>
</section>