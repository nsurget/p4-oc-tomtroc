<?php
$image = $params['image'] ?? '';
$alt = $params['alt'] ?? '';
?>

<?php if (!empty($image)): ?>
    <section class="image-full-width">
        <img src="<?= $image ?>" alt="<?= $alt ?>">
    </section>
<?php endif; ?>