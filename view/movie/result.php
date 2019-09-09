<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?>
<br><br>
<a style="text-decoration: none;" href="<?= url("../htdocs/movie") ?>">Select all |</a>
<a style="text-decoration: none;" href="<?= url("movie/search-title") ?>">Search Title |</a>
<a style="text-decoration: none;" href="<?= url("movie/search-year") ?>">Search year |</a>
<a style="text-decoration: none;" href=<?= url("movie/movie-select") ?>>CRUD </a>

<?php


if (!$resultset) {
    return;
}

?>
<br><br>
<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= "../" .  $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
<?php endforeach; ?>
</table>
