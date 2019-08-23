<?php

namespace Anax\View;

?>
<h1>100 GAME! 2.0</h1>

<h4>Throw the dice and save up to 100 to win.<h4>


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
<p><b>Dice: <?=$values ?></b></p>
<p><b>Sum: <?= $sum ?></b></p>
<p><b>Score: <?= $score ?></b></p>
<p><b><pre>Histogram: <?php echo "<br>" . $print ?></pre></b></p>
<?php endif;?>

<?php if ($simulate) :?>
<p><b>Dice: <?=$values2 ?></b></p>
<p><b>Sum: <?= $sum2 ?></b></p>
<p><b>Score: <?= $score2 ?></b></p>
<p><b><pre>Histogram: <?php echo "<br>" . $print2 ?></pre></b></p>
<?php endif;?>

<?php if ($new) :?>
    <p><b><?= $new?></b></p>
<?php endif;?>



<br><br><br>
<a href="../game/init">New Game</a>
