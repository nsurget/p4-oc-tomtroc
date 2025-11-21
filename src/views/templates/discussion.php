<section class="discussion container">
    <div class="left-side">
        <h2>Discussion</h2>
        <div class="discussion-container">
            <?php if (!empty($user)) : ?>
                nouvelle discussion
                <p><?= $user->getPseudo() ?></p>
            <?php endif; ?>

            <?php if (!empty($discussions)) : ?>
                <?php foreach ($discussions as $discussion) : ?>
                    <div class="discussion-item">
                        <p><?= $discussion->getUser1Id() ?></p>
                        <p><?= $discussion->getUser2Id() ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune discussion</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="right-side">
        
    </div>

</section>