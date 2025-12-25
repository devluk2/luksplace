<?php
$excludeArray = array('..', '.', 'thumbnails', 'luk.jpg', 'IMG_20241120_101605.jpg');
$imageDir = __DIR__ . '/../../public/images';
$imageFiles = array_diff(scandir($imageDir), $excludeArray);
shuffle($imageFiles);

?>

<h2>Watercolor Paintings</h2>
<p>I'm a self-taught watercolor artist.</p>
<p>If you want a painting please reach out - I'll be happy to help.</p>
<p>Below are some example paintings of mine.</p>

<div id="images">
    <?php foreach ($imageFiles as $imageFile) : ?>
        <img src="/public/images/<?= $imageFile; ?>" alt="<?= $imageFile; ?>" loading="lazy">
    <?php endforeach; ?>
</div>