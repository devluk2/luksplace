<?php
if (!isset($content)) {
    $content = '<p>no content</p>';
}
?>
<!DOCTYPE html>
<html id="top" lang="en" translate="no">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luks place</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <link rel="stylesheet" href="/public/css/style.css?v=<?= time(); ?>">
    <script src="https://unpkg.com/htmx.org@2.0.4" integrity="sha384-HGfztofotfshcF7+8n44JQL2oJmowVChPTg48S+jvZoztPfvwD79OC/LTtG6dMp+" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('scroll', function () {
            const jumpToTop = document.querySelector('.jump-to-top');
            if (window.scrollY > 100) {
                jumpToTop.classList.add('enabled');
            } else {
                jumpToTop.classList.remove('enabled');
            }
        });
    </script>
</head>

<body>
    <header>
        <nav>
            <a href="/">Home</a>
            <a href="/dev">Dev</a>
            <a href="/art">Art</a>
            <a href="/trading">Trading</a>
            <a href="/ideas">Ideas</a>
        </nav>
        <h1>Luks place</h1>
        <span>Regular, everyday, normal mf, trying to live in this wicked world.</span>
    </header>

    <main>
        <?php echo $content; ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> | Contact <a href="mailto:luk.berezowski@gmail.com">luk.berezowski[at]gmail.com</a> | I don't use f*cking cookies.
    </footer>


    <a class="jump-to-top" href="#top">Jump to top of page</a>
</body>

</html>