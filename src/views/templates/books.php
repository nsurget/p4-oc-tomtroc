<h1>Nos livres à l'échange</h1>


<?php foreach ($books as $book) : ?>
    <div class="book">
        <h2><?= $book->getTitle() ?></h2>
        <p><?= $book->getDescription() ?></p>
        <p><?= $book->getAvailability() ?></p>
        <p><?= $book->getUrlImage() ?></p>
        <p><?= $book->getAuthorId() ?></p>
        <p><?= $book->getUserId() ?></p>
    </div>
<?php endforeach; ?>