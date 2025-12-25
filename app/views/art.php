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
        <div class="image-container">
            <div class="skeleton skeleton-image"></div>
            <img src="/public/images/<?= $imageFile; ?>" alt="<?= $imageFile; ?>" loading="lazy" onload="handleImageLoad(this)" onerror="handleImageError(this)">
        </div>
    <?php endforeach; ?>
</div>

<script>
function handleImageLoad(img) {
    const container = img.parentElement;
    const skeleton = container.querySelector('.skeleton');
    
    img.classList.add('loaded');
    if (skeleton) {
        skeleton.style.display = 'none';
    }
}

function handleImageError(img) {
    const container = img.parentElement;
    container.remove();
}
</script>