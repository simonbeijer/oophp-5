<?php

namespace Sibj\TextFilter;

use Michelf\MarkdownExtra;

// Include essentials
// require __DIR__ . "/../src/config.php";

// require __DIR__ . "/../../vendor/autoload.php";

?>
<a style="text-decoration: none;" href="../textfilter">Index |</a>
<a style="text-decoration: none;" href="bbcode">Bbcode |</a>
<a style="text-decoration: none;" href="clickable">Link |</a>
<a style="text-decoration: none;" href="sample">Markdown |</a>
<a style="text-decoration: none;" href="nl2br">Nl2br</a>
<?php

$text = file_get_contents(__DIR__ . "/textsample/sample.md");
$mytextfilter = new MyTextFilter();
$html = $mytextfilter->parse($text, "markdown");
?><h1>Testing textfilters</h1>

<!-- markdown -->
<h1>Showing off Markdown</h1>

<h2>Markdown source in sample.md</h2>
<pre><?= $text ?></pre>

<h2>Text formatted as HTML source</h2>
<pre><?= htmlentities($html) ?></pre>

<h2>Text displayed as HTML</h2>
<?= $html ?>
