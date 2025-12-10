<?php
$book = $params['book'] ?? null;
$authors = $params['authors'] ?? [];

?>

<div class="book-form container">
    <div class="return" onclick="window.history.back()"><svg xmlns="http://www.w3.org/2000/svg" width="9" height="8"
            viewBox="0 0 9 8" fill="none">
            <path
                d="M0.146447 3.32858C-0.0488155 3.52384 -0.0488155 3.84042 0.146447 4.03568L3.32843 7.21766C3.52369 7.41293 3.84027 7.41293 4.03553 7.21766C4.2308 7.0224 4.2308 6.70582 4.03553 6.51056L1.20711 3.68213L4.03553 0.853702C4.2308 0.65844 4.2308 0.341857 4.03553 0.146595C3.84027 -0.0486672 3.52369 -0.0486672 3.32843 0.146595L0.146447 3.32858ZM8.5 4.18213C8.77614 4.18213 9 3.95827 9 3.68213C9 3.40599 8.77614 3.18213 8.5 3.18213V4.18213ZM0.5 4.18213H8.5V3.18213H0.5V4.18213Z"
                fill="#A6A6A6" />
        </svg> retour
    </div>
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
                <p>ou via une url :</p>
                <label>URL de l'image</label>
                <input type="url" name="book-url">
            </div>
        </div>
        <div class="book-info">
            <label for="title">Titre <span class="required">*</span></label>
            <input type="text" id="title" name="title" value="<?= $book?->getTitle() ?? '' ?>"
                placeholder="Titre du livre" required>
            <label for="author_id">Auteur <span class="required">*</span></label>
            <input type="text" list="authors_list" id="author_name" name="author_name"
                placeholder="Trouver ou ajouter un auteur..."
                value="<?= !empty($book) && $book->getAuthorName() ? $book->getAuthorName() : '' ?>">


            <datalist id="authors_list">
                <?php foreach ($authors as $author): ?>
                    <option value="<?= $author->getName() ?>" data-id="<?= $author->getId() ?>">
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