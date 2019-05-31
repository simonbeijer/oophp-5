<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("100-game/init", function () use ($app) {
    // Init the session for the gamestart.
    $game = new Sibj\Game\Game();
    $_SESSION["counter"] = null;

    $computer = new Sibj\Game\Computer();
    $_SESSION["counter2"] = null;

    $_SESSION["new"] = "New Game";

    return $app->response->redirect("100-game/play");
});


/**
 * Play the game - show game status.
 */
$app->router->get("100-game/play", function () use ($app) {
    $title = "100 Game";


    //Incoming variables
    $new = $_SESSION["new"] ?? null;
    $res = $_SESSION["res"] ?? null;

    $throw = $_SESSION["throw"] ?? null;
    $save = $_SESSION["save"] ?? null;
    $simulate = $_SESSION["simulate"] ?? null;

    //Player
    $values = $_SESSION["values"] ?? null;
    $counter = $_SESSION["counter"] ?? null;
    $score = $_SESSION["score"] ?? null;
    $sum = $_SESSION["sum"] ?? null;

    //Computer
    $values2 = $_SESSION["values2"] ?? null;
    $score2 = $_SESSION["score2"] ?? null;
    $counter2 = $_SESSION["counter2"] ?? null;
    $sum2 = $_SESSION["sum2"] ?? null;

    $_SESSION["throw"] = null;
    $_SESSION["save"] = null;
    $_SESSION["simulate"] = null;

    $_SESSION["res"] = null;
    $_SESSION["new"] = null;



    $data = [
        "throw" => $throw,
        "save" => $save,
        "simulate" => $simulate,
        "values" => $values,
        "counter" => $counter,
        "sum" => $sum,
        "score" => $score,
        "values2" => $values2,
        "counter2" => $counter2,
        "sum2" => $sum2,
        "score2" => $score2,
        "res" => $res,
        "new" => $new,
    ];

    $app->page->add("100-game/play", $data);
    $app->page->add("100-game/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game - make a guess.
 */
$app->router->post("100-game/play", function () use ($app) {

    //Incoming variables

    $throw = $_POST["throw"] ?? null;
    $save = $_POST["save"] ?? null;
    $simulate = $_POST["simulate"] ?? null;

    //Player
    $values = $_SESSION["values"] ?? null;
    $counter = $_SESSION["counter"] ?? null;
    $score = $_SESSION["score"] ?? null;
    $sum = $_SESSION["sum"] ?? null;

    //Computer
    $values2 = $_SESSION["values2"] ?? null;
    $score2 = $_SESSION["score2"] ?? null;
    $counter2 = $_SESSION["counter2"] ?? null;
    $sum2 = $_SESSION["sum2"] ?? null;


    if ($_POST["throw"]) {
        $_SESSION["throw"] = $throw;
        $game = new Sibj\Game\Game();
        $game->random();
        $_SESSION["sum"] = $game->sum();
        $sum = $_SESSION["sum"];
        $counter += $game->sum();
        $_SESSION["counter"] = $counter;
        $game->addScore($counter);
        $_SESSION["values"] = implode(", ", $game->values());
        $counter = $_SESSION["counter"];
        $score = $game->score();
        $_SESSION["score"] = $score;
        $res = $game->checkNumber();
        $_SESSION["res"] = $res;
    } elseif ($save) {
        $_SESSION["save"] = $save;
        $res = "Saved, simulate for computer.";
        $_SESSION["res"] = $res;
    }

    if ($simulate) {
        $_SESSION["simulate"] = $simulate;
        $computer = new Sibj\Game\Computer();
        $computer->random();
        $_SESSION["sum2"] = $computer->sum();
        $sum2 = $_SESSION["sum2"];
        $counter2 += $computer->sum();
        $_SESSION["counter2"] = $counter2;
        $computer->addScore($counter2);
        $_SESSION["values2"] = implode(", ", $computer->values());
        $counter2 = $_SESSION["counter2"];
        $score2 = $computer->score();
        $_SESSION["score2"] = $score2;
        $res = $computer->checkNumberSum($sum2);
        $_SESSION["res"] = $res;
    }


    return $app->response->redirect("100-game/play");
});
