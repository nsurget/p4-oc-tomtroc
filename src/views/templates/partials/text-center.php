<?php
$title = $params['title'] ?? '';
$text = $params['text'] ?? '';
$text_legend = $params['text-legend'] ?? '';
$signature_image = $params['signature-image'] ?? '';
?>

<section class="text-center">
    <div class="small-container text-center__container">
        <div class="text">
            <?php if (!empty($title)): ?>
                <h2><?= $title ?></h2>
            <?php endif; ?>
            <?php if (!empty($text)): ?>
                <p class="text-content"><?= $text ?></p>
            <?php endif; ?>
            <div class="signature">
                <?php if (!empty($text_legend)): ?>
                    <p><?= $text_legend ?></p>
                <?php endif; ?>
                <?php if (!empty($signature_image)): ?>
                    <picture>
                        <img src="<?= $signature_image ?>" alt="Signature">
                    </picture>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>