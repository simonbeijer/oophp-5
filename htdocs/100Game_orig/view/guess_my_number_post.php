<h1>100 GAME!</h1>

<h4>Throw the dice and save up to 100 to winn.<h4>

<form method="post" >
    <fieldset>
        <label>Player: </label>
        <input type="submit" name="throw" value="Throw">
        <input type="submit" name="save" value="Save">
        <label>Computer: </label>
        <input type="submit" name="simulate" value="Simulate">
    </fieldset>
</form>

<?php if ($res) :?>
    <p><b><?= $res?></b></p>
<?php endif;?>

<?php if ($throw) :?>
<p><b>Dice: <?=implode(", " ,$game->values()) ?></b></p>

<p><b>Sum: <?= $game->sum() ?></b></p>

<p><b>Score: <?= $score ?></b></p>
<?php endif;?>


<?php if ($simulate) :?>
<p><b>Dice: <?=implode(", " ,$computer->values()) ?></b></p>

<p><b>Sum: <?= $computer->sum() ?></b></p>

<p><b>Score: <?= $score2 ?></b></p>
<?php endif;?>
