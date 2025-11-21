<?php 
$title = $params['title'] ?? '';
$text = $params['text'] ?? '';
$button = $params['button'] ?? '';
$button_url = $params['button-url'] ?? '';
$image = $params['image'] ?? '';
$image_legend = $params['image-legend'] ?? '';
?>

<section class="text-image container">
    <div class="text">
        <?php if (!empty($title)): ?>
            <h2><?= $title ?></h2>
        <?php endif; ?>
        <?php if (!empty($text)): ?>
            <p><?= $text ?></p>
        <?php endif; ?>
        <?php if (!empty($button)): ?>
            <a href="<?= $button_url ?>" class="button"><?= $button ?></a>
        <?php endif; ?>
    </div>
    <div class="image">
        <?php if (!empty($image)): ?>
            <img src="<?= $image ?>" alt="Image de <?= $image_legend ?>">
        <?php endif; ?>
        <?php if (!empty($image_legend)): ?>
            <p><?= $image_legend ?></p>
        <?php endif; ?>
    </div>
</section>