<?php
namespace Sibj\Game;

/**
 * 100 Game, a class supporting the game through GET, POST and SESSION.
 */
class Game
{
    /**
     * @var int $dices   Number of dices.
     * @var array $values    Number of throw.
     */
    private $dices;
    private $values;
    private $score;
    private $res;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Creating a array of dices.

     * @param int $dices  Number of dices the will be thrown.
     */

    public function __construct(int $dices = 2)
    {
        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = rand(1, 6);
            $this->values[] = $i;
        }
    }

    /**
     * Randomize the dice for every throw.
     *
     * @return void
     */

    public function random()
    {
        foreach ($this->values as $key => $values) {
            $this->values[$key] = rand(1, 6);
        }
    }

    /**
     * Get the throws.
     *
     * @return array as the throws values.
     */

    public function values()
    {
        return $this->values;
    }

    /**
     * Gets the counter number.
     *
     * Adds to score
     */

    public function addScore(int $counter)
    {
        $this->score = $counter;
    }

    /**
     * Get the score of game.
     *
     * @return int as the score number.
     */

    public function score()
    {
        return $this->score;
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        return array_sum($this->values);
    }

    /**
     * Throw dice and cheak if the number, if the number is 0 counter empty
     * If number 100 there is a winner
     *
     * @return string to show the status of game.
     */

    public function checkNumber()
    {
        if (in_array(1, $this->values)) {
            $this->res = "You lost you points, simulate for computer.";
            $_SESSION["counter"] = 0;
        }
        if ($this->score > 99) {
            $this->res = "You have won, computers have no chance.";
            $_SESSION["counter"] = 0;
            $_SESSION["counter2"] = 0;
        }
        return $this->res;
    }
}
