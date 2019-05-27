<?php
/**
 * Show off the autoloader.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");


$throw = $_POST["throw"] ?? null;
$save = $_POST["save"] ?? null;
$simulate = $_POST["simulate"] ?? null;

$score = $_SESSION["score"] ?? null;
$score2 = $_SESSION["score2"] ?? null;

$res = null;
$game = null;
$score = null;
$score2 = null;

if ($throw) {
    // $game = new Game();
    // $game->random();
    // $_SESSION["score"] += $game->sum();
    // $score = $_SESSION["score"];
    if ( in_array(1, $game->values())) {
        $res = "You lost you points, simulate for computer.";
        $_SESSION["score"] = null;
    } if ($score >= 100) {
        $res = "You have wonn, computers have no chance.<br>Just play again!";
        $_SESSION["score"] = null;
        $_SESSION["score2"] = null;
    }
} elseif ($save) {
    $score = $_SESSION["score"];
    $res = "Saved, simulate for computer.";
}
if ($simulate) {
    // $computer = new Game();
    // $computer->random();
    // $_SESSION["score2"] += $computer->sum();
    // $score2 = $_SESSION["score2"];
    if ( in_array(1, $computer->values())) {
        $res = "Computer lost its points, your turn to throw.";
        $_SESSION["score2"] = null;
    } elseif (in_array(6, $computer->values()) | $computer->sum() >= 9) {
        $res = "Computer is done, your turn to throw.";
        $score2 = $_SESSION["score2"];
    } if ($score2 >= 100) {
        $res = "You have lost, computers will take over the world.<br>Just play again!";
        $_SESSION["score"] = null;
        $_SESSION["score2"] = null;
    }
}




// render page
require __DIR__ . "/view/guess_my_number_post.php";
// require __DIR__ . "/view/debugview.php";
