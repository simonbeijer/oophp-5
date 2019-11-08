<?php
namespace Anax\View;

if (isset($_GET['slug'])) {
    $errorSlug = $_GET['slug'];

    echo "<h3>Din slug " . $errorSlug . " finns redan. Var vänlig byt ut din slug!<h3>";
} else {
    echo " ";
}

?>
<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="contentId" value="<?= $resultset->id ?>"/>

    <p>
        <label>Title:<br>
        <input type="text" name="contentTitle" value="<?= $resultset->title ?>"/>
        </label>
    </p>

    <p>
        <label>Path:<br>
        <input type="text" name="contentPath" value="<?= $resultset->path ?>"/>
    </p>

    <p>
        <label>Slug:<br>
        <input type="text" name="contentSlug" value="<?= $resultset->slug ?>"/>
    </p>

    <p>
        <label>Text:<br>
        <textarea name="contentData"><?= $resultset->data ?></textarea>
     </p>

     <p>
         <label>Type:<br>
         <input type="text" name="contentType" value="<?= $resultset->type ?>"/>
     </p>

     <p>
         <label>Filter:<br>
         <input type="text" name="contentFilter" value="<?= $resultset->filter ?>"/>
     </p>

     <p>
         <label>Publish:<br>
         <input type="datetime" name="contentPublish" value="<?= $resultset->published ?>"/>
     </p>

    <p>
        <button type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </p>
    </fieldset>
</form>
