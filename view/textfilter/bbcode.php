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


$text = file_get_contents(__DIR__ . "/textsample/bbcode.txt");
$mytextfilter = new MyTextFilter();
$html = $mytextfilter->parse($text, "bbcode,nl2br");

?>
<div class="div_textsample" >
<h1>Testing textfilters</h1>

<!-- bbcode -->
<h2>Showing off BBCode and nl2br</h2>

<h3>Source in bbcode.txt</h3>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h3>Filter BBCode applied, source</h3>
<pre><?= wordwrap(htmlentities($html)) ?></pre>

<h3>Filter BBCode applied, HTML (including my method for nl2br())</h3>
<?= $html ?>
</div>
