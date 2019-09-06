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

?>

<form method="post">
    <fieldset>
    <legend>Select Movie</legend>

    <p>
        <label>Movie:<br>
        <select name="movieId">
            <option value="">Select movie...</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doAdd" value="Add">
        <input type="submit" name="doEdit" value="Edit">
        <input type="submit" name="doDelete" value="Delete">
    </p>
    <p><a href="?">Show all</a></p>
    </fieldset>
</form>


<?php
