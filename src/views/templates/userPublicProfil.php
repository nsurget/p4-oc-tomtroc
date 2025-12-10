<?php
/*
    Template for user profil for logged in users.
*/
?>

<section class="user-profil public-profil container">
    <div class="user-profil-container">
        <div class="user-profil">
            <div class="user-picture">
                <?= $user->displayImage() ?>
            </div>
            <div class="sep"></div>
            <div class="user-info">
                <p class="user-pseudo"><?= $user->getPseudo() ?></p>
                <p class="user-member-since"><?= $user->getMemberSince() ?></p>
                <p class="user-library">BIBLIOTHEQUE</p>
                <p class="user-library-count"><img src="./uploads/book.svg" alt="icon de livres"> <?= count($books) ?>
                    Livres</p>
                <a href="?action=<?= AppRoutes::SHOW_DISCUSSION ?>&id=<?= $user->getId() ?>"
                    class="btn btn-secondary">Écrire un message</a>
            </div>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</section>