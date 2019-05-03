<?php
/**
 * Show off the autoloader.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");


$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

$number = $_SESSION["number"] ?? null;
$tries = $_SESSION["tries"] ?? null;
$res = null;
$game = null;


// $game = New Guess()
// // $number = $game->random();
// //
// $res = $game->makeGuess($guess);

if ($doInit || $number === null) {
    $game = new Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();
    header("Refresh:0");
} elseif ($doGuess) {
    $game = new Guess($number, $tries);
    $res = $game->makeGuess($guess);
    $_SESSION["tries"] = $game->tries();
}





// render page
require __DIR__ . "/view/guess_my_number_post.php";
require __DIR__ . "/view/debugview.php";
