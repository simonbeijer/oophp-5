<?php
namespace Anax\View;

?>

<article>
    <header>
        <h1><?= $content->title ?></h1>
        <p><i>Published: <time datetime="<?= $content->published_iso8601 ?>" pubdate><?= $content->published ?></time></i></p>
    </header>
    <?= $html ?>
</article>
