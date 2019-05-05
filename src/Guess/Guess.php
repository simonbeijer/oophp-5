<?php

namespace Sibj\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $number;
    private $tries;
    private $res;
    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->tries = $tries;
        if ($number === -1) {
            $number = rand(1, 100);
        } $this->number = $number;
    }




    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        $this->number = rand(1, 100);
    }




    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return $this->tries;
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }





    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */

    public function makeGuess(int $guess)
    {

        if (!($guess > 0 && $guess <= 100)) {
            throw new GuessException("Number is out of bounds.");
        }
        $this->tries --;
        if ($guess === $this->number) {
            $this->res = "Correct! Press'Start from beginning' to play again.";
        } elseif ($guess > $this->number) {
            $this->res = "To High!";
        } else {
            $this->res = "To Low!";
        } if ($this->tries === 0) {
            $this->res = "No more trys! Press'Start from beginning' to play again.";
        } if ($this->tries === -1) {
            session_destroy();
        }
          return $this->res;
    }
}
