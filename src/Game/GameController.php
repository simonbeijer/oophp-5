<?php

namespace Sibj\Game;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class GameController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    //private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "Index!";
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game!!";
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction() : ob
    {
        $session = $this->app->session;
        $response = $this->app->response;
        // Init the session for the gamestart.
        $game = new Game();
        $session->set("counter", null);

        $computer = new Computer();
        $session->set("counter2", null);

        $session->set("new", "New Game");

        return $response->redirect("game/play");
    }




    /**
    * This is the index method action, it handles:
    * ANY METHOD mountpoint
    * ANY METHOD mountpoint/
    * ANY METHOD mountpoint/index
    * Play the game - show game status.
    *
    * @return string
    */
    public function playActionGet() : object
    {
        $session = $this->app->session;
        $page = $this->app->page;
        $title = "100 Game 2.0";


        //Incoming variables
        $new = $session->get("new");
        $res = $session->get("res");

        $throw = $session->get("throw");
        $save = $session->get("save");
        $simulate = $session->get("simulate");


        //Player
        $values = $session->get("values");
        $counter = $session->get("counter");
        $score = $session->get("score");
        $sum = $session->get("sum");
        $print = $session->get("print");
        $savehistogram = $session->get("savehistogram");


        //Computer
        $values2 = $session->get("values2");
        $counter2 = $session->get("counter2");
        $score2 = $session->get("score2");
        $sum2 = $session->get("sum2");



        $session->set("throw", null);
        $session->set("save", null);
        $session->set("simulate", null);

        $session->set("res", null);
        $session->set("new", null);


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
            "print" => $print,
            "save" => $save,
            "savehistogram" => $savehistogram,
        ];

        $page->add("game/play", $data);
        $page->add("game/debug");

        return $page->render([
            "title" => $title,
        ]);
    }




    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;


        //Incoming variables
        $throw = $request->getPost("throw");
        $save = $request->getPost("save");
        $simulate = $request->getPost("simulate");

        //Player
        $values = $session->get("values");
        $counter = $session->get("counter");
        $score = $session->get("score");
        $sum = $session->get("sum");
        $print = $session->get("print");
        $savehistogram = $session->get("savehistogram");


        //Computer
        $values2 = $session->get("values2");
        $counter2 = $session->get("counter2");
        $score2 = $session->get("score2");
        $sum2 = $session->get("sum2");



        if ($request->getPost("throw")) {
            $session->set("throw", $throw);
            $game = new Game();

            $game = new DiceHistogram2();

            $game->random();

            $histogram = new Histogram();
            $histogram->injectData($game);

            $session->set("print", $histogram->getAsText());
            $session->set("savehistogram", $histogram->getSerie());

            $session->set("sum", $game->sum());
            $counter += $game->sum();
            $session->set("counter", $counter);
            $game->addScore($counter);
            $session->set("values", implode(", ", $game->values()));
            $session->set("counter", $counter);
            $score = $game->score();
            $session->set("score", $score);
            $res = $game->checkNumber();
            $session->set("res", $res);

        } elseif ($request->getPost("save")) {
            $session->set("save", $save);
            $res = "Saved, simulate for computer.";
            $session->set("res", $res);
        }

        if ($request->getPost("simulate")) {
            $session->set("simulate", $simulate);
            $computer = new Computer();

            $computer = new DiceHistogram2();

            $computer->random();

            $histogram = new Histogram();
            $histogram->injectData($computer);
            // $session->set($print, "print");
            $session->set("print", implode(", ", $computer->values()));
            $session->set("print", $histogram->getAsText());
            $session->set("sum2", $computer->sum());
            $counter2 += $computer->sum();
            $session->set("counter2", $counter2);
            $computer->addScore($counter2);
            $session->set("values2", implode(", ", $computer->values()));
            $session->set("counter2", $counter2);
            $score2 = $computer->score();
            $session->set("score2", $score2);
            $res = $computer->checkNumberSum($sum2);
            $session->set("res", $res);
        }


        return $response->redirect("game/play");
    }
}
