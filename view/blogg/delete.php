<?php
namespace Anax\View;

?>

<form method="post">
    <fieldset>
    <legend>Delete</legend>

    <input type="hidden" name="id" value="<?= $resultset->id ?>"/>

    <p>
        <label>Title:<br>
            <input type="text" name="contentTitle" value="<?= $resultset->title ?>" readonly/>
        </label>
    </p>

    <p>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </p>
    </fieldset>
</form>
