<?php
$book = $params['book'] ?? null;
$authors = $params['authors'] ?? [];
?>

<div class="book-form container">
    <?php if ($book): ?>
        <h2>Modifier un livre</h2>
    <?php else: ?>
        <h2>Ajouter un livre</h2>
    <?php endif; ?>
    <form action="?action=<?= AppRoutes::SAVE_BOOK ?>" method="post">
        <input type="hidden" name="id" value="<?= $book?->getId() ?? -1 ?>">
        <div class="book-image">
            <?php if ($book): ?>
                <?= $book->displayImage() ?>
                <p>Modifier l'image</p>
            <?php else: ?>
                <img src="/uploads/default.png" alt="placeholder">
                <p>Ajouter une image</p>
            <?php endif; ?>


            <div class="edit-form">
                <label>Uploader une image</label>
                <input type="file" name="book-picture">
                <p>Format accepté : .png, .jpg, .jpeg, .gif</p>
                <p>Taille max : 2Mo</p>
                <p>ou via un url :</p>
                <label>URL de l'image</label>
                <input type="url" name="book-url">
            </div>
        </div>
        <div class="book-info">
            <label for="title">Titre <span class="required">*</span></label>
            <input type="text" id="title" name="title" value="<?= $book?->getTitle() ?? '' ?>"
                placeholder="Titre du livre" required>
            <label for="author_id">Auteur <span class="required">*</span></label>
            <input type="text" list="authors_list" id="author_search" placeholder="Rechercher un auteur..."
                value="<?= $book && $book->getAuthorName() ? $book->getAuthorName() : '' ?>">
            

            <datalist id="authors_list">
                <?php foreach ($authors as $author): ?>
                    <option value="<?= $author->getFirstName() . ' ' . $author->getLastName() ?>"
                        data-id="<?= $author->getId() ?>">
                    </option>
                <?php endforeach; ?>
            </datalist>
            <label for="description">Description <span class="required">*</span></label>
            <textarea id="description" name="description" required><?= $book?->getDescription() ?? '' ?></textarea>
            <label for="availability">Disponibilité <span class="required">*</span></label>
            <select name="availability" id="availability" required>
                <?php foreach (Utils::getBookStatus() as $status => $label): ?>
                    <option value="<?= $status ?>" <?= $book?->getAvailability() == $status ? 'selected' : '' ?>><?= $label ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Valider</button>
        </div>
    </form>
</div>