<?php

$title = $params['title'] ?? '';
$recentBooks = $params['recentBooks'] ?? [];
$button = $params['button'] ?? '';
$button_url = $params['button-url'] ?? '';
?>
<section class="last-books small-container">
    <?php if (!empty($title)): ?>
        <h2><?= $title ?></h2>
    <?php endif; ?>
    <?php if (!empty($recentBooks)): ?>
        <div class="books">
            <?php foreach ($recentBooks as $book): ?>
                <?php Utils::getTemplatePart('book-card', ['book' => $book]); ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($button)): ?>
        <div class="btn-container">
            <a href="<?= $button_url ?>" class="btn btn-primary"><?= $button ?></a>
        </div>
    <?php endif; ?>
</section>