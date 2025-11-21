<?php

$title = $params['title'] ?? '';
$text = $params['text'] ?? '';
$faq = $params['faq'] ?? [];
$button = $params['button'] ?? '';
$button_url = $params['button-url'] ?? '';
?>
<section class="faq container">
    <?php if (!empty($title)): ?>
        <h2><?= $title ?></h2>
    <?php endif; ?>
    <?php if (!empty($text)): ?>
        <p><?= $text ?></p>
    <?php endif; ?>
    <?php if (!empty($faq)): ?>
        <div class="faq-list">
            <?php foreach ($faq as $item): ?>
                <div class="faq-item">
                    <p><?= $item['answer'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($button)): ?>
        <a href="<?= $button_url ?>" class="button"><?= $button ?></a>
    <?php endif; ?>
</section>