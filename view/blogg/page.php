<?php
namespace Anax\View;

?>
<article>
    <header>
        <h1><?=$resultset->title ?></h1>
        <p><i>Latest update: <time datetime="<?= $resultset->modified_iso8601 ?>"pubdate><?= $resultset->modified ?></time></i></p>
    </header>
    <?= $html ?>
</article>
