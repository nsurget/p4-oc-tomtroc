<?php
/*
    Template for user profile for logged in users.
*/
?>

<section class="user-profil container">
    <h1>Mon compte</h1>
    <div class="user-profil-container">
        <div class="user-profil">
            <div class="user-picture">
                <?= $user->displayImage() ?>
                <button class="edit-picture-button">modifier</button>
                <div class="edit-picture-form" style="display: none;">
                    <form action="?action=<?= AppRoutes::USER_EDIT_PICTURE ?>" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                        <div class="upload-picture">
                            <label>Uploader une image</label>
                            <input type="file" name="profil-picture" id="profil-picture">
                            <p>Format accepté : .png, .jpg, .jpeg, .gif</p>
                            <p>Taille max : 2Mo</p>
                        </div>
                        <div class="url-picture">
                            <p>ou via une url :</p>
                            <label>URL de l'image</label>
                            <input type="url" name="profil-url" id="profil-url">
                        </div>
                        <button type="submit">Enregistrer</button>
                    </form>
                </div>
            </div>
            <div class="sep"></div>
            <div class="user-info">
                <p class="user-pseudo"><?= $user->getPseudo() ?></p>
                <p class="user-member-since"><?= $user->getMemberSince() ?></p>
                <p class="user-library">BIBLIOTHEQUE</p>
                <p class="user-library-count"><img src="./uploads/book.svg" alt="icon de livres"> <?= count($books) ?>
                    Livres</p>
                <a href="?action=<?= AppRoutes::ADD_BOOK_FORM ?>" class="btn btn-secondary">Ajouter un livre</a>
            </div>
        </div>
        <div class="user-form">
            <form action="?action=<?= AppRoutes::USER_EDIT ?>" method="post">
                <p>Vos informations personnelles</p>
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?= $user->getEmail() ?>">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password">
                <label for="pseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" value="<?= $user->getPseudo() ?>">
                <button type="submit" class="btn btn-secondary">Enregistrer</button>
            </form>
        </div>
    </div>
    <?php if (!empty($books)): ?>
        <div class="user-books">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Description</th>
                        <th>Disponibilité</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td>
                                <div class="inner"><?= $book->displayImage() ?></div>
                            </td>
                            <td>
                                <div class="inner"><a
                                        href="?action=<?= AppRoutes::SHOW_SINGLE_BOOK ?>&id=<?= $book->getId() ?>"><?= $book->getTitle() ?></a>
                                </div>
                            </td>
                            <td>
                                <div class="inner"><?= $book->getAuthorName() ?></div>
                            </td>
                            <td>
                                <div class="inner"><?= $book->getDescription() ?></div>
                            </td>
                            <td>
                                <div class="inner"><?= $book->displayAvailability() ?></div>
                            </td>
                            <td>
                                <div class="inner">
                                    <a href="?action=<?= AppRoutes::EDIT_BOOK_FORM . '&id=' . $book->getId() ?>" class="edit-book">Éditer</a>
                                    <a href="?action=<?= AppRoutes::DELETE_BOOK . '&id=' . $book->getId() ?>" class="delete-book">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</section>