<?php


/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Game
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $tries;
    private $res;
    private $dices;
    private $values;
    private $score;
    private $one;
    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
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
     * Randomize the secret number between 1 and 100 to initiate a new game.
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
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function values()
    {
        return $this->values;
    }

    /**
     * Get the secret number.
     *
     * @return int as the secret number.
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
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */

    public function cheakNumber()
    {
        if (strpos($try, $one)) {
            $this->res = "fart";
        }
          return $this->res;
    }
}
