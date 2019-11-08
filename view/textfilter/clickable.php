<?php

namespace Sibj\TextFilter;

use Michelf\MarkdownExtra;

// Include essentials
// require __DIR__ . "/../src/config.php";
require __DIR__ . "/../../vendor/autoload.php";

?>
<a style="text-decoration: none;" href="../textfilter">Index |</a>
<a style="text-decoration: none;" href="bbcode">Bbcode |</a>
<a style="text-decoration: none;" href="clickable">Link |</a>
<a style="text-decoration: none;" href="sample">Markdown |</a>
<a style="text-decoration: none;" href="nl2br">Nl2br</a>
<?php

$text = file_get_contents(__DIR__ . "/textsample/clickable.txt");
$mytextfilter = new MyTextFilter();
$html = $mytextfilter->parse($text, "link");

?>
<div class="div_textsample" >
<h1>Testing textfilters</h1>

<!-- clickable -->
<h2>Showing off Clickable</h2>

<h3>Source in clickable.txt</h3>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h3>Source formatted as HTML</h3>
<?= $text ?>

<h3>Filter Clickable applied, source</h3>
<p><?= wordwrap(htmlentities($html)) ?></p>

<h3>Filter Clickable applied, HTML</h3>
<?= $html ?>
</div>
