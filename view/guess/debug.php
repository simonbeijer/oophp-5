<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><hr><h1>Debug</h1>

<h4>session<h4>
<pre>
<?php var_dump($_SESSION)   ?>
<br>
<h4>post<h4>
<?php var_dump($_POST)  ?>
<br>
<h4>get<h4>
<?php var_dump($_GET)   ?>
<br>
<h4>Data<h4>
<?php var_dump($data)   ?>
<br>
</pre>
<hr>
