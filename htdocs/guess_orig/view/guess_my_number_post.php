<h1>Guess my number</h1>

<h4>Guess the number between 1 and 100, you have <?= $tries?> tries left.<h4>

<form method="post" >
    <fieldset>
        <label>Guess the number: </label>
        <input type="text" name="guess">
        <input type="submit" name="doGuess" value="Make a guess">
        <input type="submit" name="doInit" value="Start from beginning">
        <input type="submit" name="doCheat" value="Cheat">
    </fieldset>
</form>

<?php if ($doGuess) :?>
    <p>You guess was <?= $guess?> it's <b><?= $res?></b></p>
<?php endif;?>
<?php if ($doCheat) :?>
    <b>Cheat</b>
    <p>The number was <b><?= $number?></b></p>
<?php endif;?>
