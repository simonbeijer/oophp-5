<?php
/**
 * Create routes using $app programming style.
 */

//var_dump(array_keys(get_defined_vars()));

/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the session for the gamestart.
    $game = new Sibj\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("guess/play");
});



/**
 * Play the game - show game status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";


    // //Incoming variables
    // $guess = $_POST["guess"] ?? null;
    // $doInit = $_POST["doInit"] ?? null;
    // $doGuess = $_POST["doGuess"] ?? null;
    // $doCheat = $_POST["doCheat"] ?? null;

    //$number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;
    // $doInit = $_SESSION["doInit"] ?? null;
    $number = $_SESSION["number"] ?? null;
    $number = $_SESSION["newRes"] ?? null;


    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;
    $_SESSION["doCheat"] = null;
    $_SESSION["newRes"] = null;
    // $_SESSION["doInit"] = null;
    // $_SESSION["doCheat"] = null;
    // $_SESSION["number"] = null;
    // $res = null;
    // $game = null;

    // if ($doGuess) {
    //     $game = new Sibj\Guess\Guess($number, $tries);
    //     $res = $game->makeGuess($guess);
    //     $_SESSION["tries"] = $game->tries();
    // }

    $data = [
        "guess" => $guess ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game - make a guess.
 */
$app->router->post("guess/play", function () use ($app) {

    //Incoming variables
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;

    // $res = null;
    // $game = null;

    if ($doGuess) {
        $game = new Sibj\Guess\Guess($number, $tries);
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
    } elseif ($doCheat) {
        $_SESSION["doCheat"] = $doCheat;
    } elseif ($doInit || $number === null) {
        $game = new Sibj\Guess\Guess();
        $_SESSION["number"] = $game->number();
        $_SESSION["tries"] = $game->tries();
        $_SESSION["newRes"] = "New game";
    }

    // $data = [
    //     "guess" => $guess,
    //     "tries" => $tries,
    //     "number" => $number,
    //     "res" => $res,
    //     "doGuess" => $doGuess,
    //     "doCheat" => $doCheat,
    // ];

    return $app->response->redirect("guess/play");
});
