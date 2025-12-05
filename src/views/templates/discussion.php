<section class="discussion container">
    <div class="left-side">
        <h2>Messagerie</h2>
        <div class="discussion-container">
            <?php if (!empty($discussions)): ?>
                <?php foreach ($discussions as $discussion): ?>
                    <a
                        href="?action=<?= AppRoutes::SHOW_DISCUSSION ?>&id=<?= $discussion->getOtherUserId($_SESSION['idUser']) ?>">
                        <div class="discussion-item <?= $discussion->getId() === $active_discussion_id ? 'active' : '' ?>">
                            <div class="picture">
                                <?= $discussion->displayImage() ?>
                            </div>
                            <div class="info">
                                <div class="top">
                                    <p><?= $discussion->getRequestUserPseudo() ?></p>
                                    <p><?= $discussion->getFormatLastMessageAt() ?></p>
                                </div>
                                <div class="bottom">
                                    <p><?= $discussion->getLastMessageContent() ?></p>
                                    <?php if ($discussion->getNewMessagesCount() > 0): ?>
                                        <p><?= $discussion->getNewMessagesCount() ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune discussion</p>
            <?php endif; ?>
        </div>

    </div>
    <div class="right-side">
        <?php if (!empty($request_user)): ?>
            <div class="user-info">
                <div class="picture">
                    <?= $request_user->displayImage() ?>
                </div>
                <div class="info">
                    <p><?= $request_user->getPseudo() ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($messages)): ?>

            <div class="messages-container">
                <div class="messages">
                    <?php foreach ($messages as $message): ?>
                        <?php if ($message->getUserId() == $_SESSION['idUser']): ?>
                            <div class="message right">
                                <div class="top">
                                    <p><?= $message->getFormatCreatedAt() ?></p>
                                </div>
                                <div class="content">
                                    <p><?= $message->getContent() ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="message left">
                                <div class="top">
                                    <div class="picture">
                                        <?= $request_user->displayImage() ?>
                                    </div>
                                    <p><?= $message->getFormatCreatedAt() ?></p>
                                </div>
                                <div class="content">
                                    <p><?= $message->getContent() ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <p>Aucun message</p>
        <?php endif; ?>

        <?php if (!empty($request_user)): ?>
        <form action="?action=<?= AppRoutes::SEND_MESSAGE ?>&id=<?= $request_user->getId() ?>" method="post">
            <input type="text" name="content" placeholder="Message">
            <button type="submit">Envoyer</button>
        </form>
        <?php endif; ?>
    </div>

</section>