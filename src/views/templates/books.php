<section class="books-archive container">
    <?php if (isset($search)) : ?>
        <h1>Résultats pour "<?= $search ?>"</h1>
    <?php else : ?>
        <h1>Nos livres à l'échange</h1>
    <?php endif; ?>

    <form action="?action=<?= AppRoutes::SHOW_BOOKS; ?>" method="post">
        <input type="text" name="search" placeholder="Rechercher un livre">
        <button type="submit"></button>
    </form>
    <div class="books-list">
        <?php foreach ($books as $book): ?>
            <?php Utils::getTemplatePart('book-card', ['book' => $book]); ?>
        <?php endforeach; ?>
    </div>
</section>