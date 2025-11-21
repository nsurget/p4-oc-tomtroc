<?php
$book = $params['book'] ?? null;

?>

<div class="book-form container">
    <?php if ($book): ?>
        <h2>Modifier un livre</h2>
    <?php else: ?>
        <h2>Ajouter un livre</h2>
    <?php endif; ?>
    <form action="?action=<?= AppRoutes::SAVE_BOOK ?>" method="post">
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" value="<?= $book ?->getTitle() ?? '' ?>">
        <label for="author_id">Auteur</label>
        <input type="text" id="author_id" name="author_id" value="<?= $book ?->getAuthorId() ?? '' ?>">
        <label for="description">Description</label>
        <textarea id="description" name="description"><?= $book ?->getDescription() ?? '' ?></textarea>
        <label for="availability">Disponibilité</label>
        <select name="availability" id="availability">
            <?php foreach (Utils::getBookStatus() as $status => $label): ?>
                <option value="<?= $status ?>" <?= $book ?->getAvailability() == $status ? 'selected' : '' ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Valider</button>
    </form>
</div>