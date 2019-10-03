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


$text = "Detta är första raden\noch detta är andra";
$mytextfilter = new MyTextFilter();
$html = $mytextfilter->parse($text, "nl2br");

?>
<div class="div_textsample" >
<h1>Testing textfilters</h1>

<!-- bbcode -->
<h2>Showing off nl2br</h2>

<h3>Source in nl2br.txt</h3>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h3>Filter nl2br applied, source</h3>
<pre><?= wordwrap(htmlentities($html)) ?></pre>
</div>
