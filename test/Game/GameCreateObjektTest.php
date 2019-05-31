<?php

namespace Sibj\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $game = new Game();
        $this->assertInstanceOf("\Sibj\Game\Game", $game);

        $res = $game->random();
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Sum under 12(6+6).
     */
    public function testCreateObjectSumLess()
    {
        $game = new Game();
        $this->assertInstanceOf("\Sibj\Game\Game", $game);
        $game->random();
        $res = $game->sum();

        $this->assertLessThan(13, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Sum over 1 (1+1).
     */
    public function testCreateObjectSumGreater()
    {
        $game = new Game();
        $this->assertInstanceOf("\Sibj\Game\Game", $game);
        $game->random();
        $res = $game->sum();

        $this->assertGreaterThan(1, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Add score same as score with counter.
     */
    public function testCreateObjectAddScore()
    {
        $game = new Game();
        $this->assertInstanceOf("\Sibj\Game\Game", $game);
        $game->random();
        $exp = $game->score();
        $res = $game->addScore(42);

        $this->assertEquals($exp, $res);
    }

    public function testCreateObjectScore2()
    {
        $game = new Game();
        $this->assertInstanceOf("\Sibj\Game\Game", $game);
        $game->random();
        $exp = $game->score();
        $res = $game->addScore(42);

        $this->assertEquals($exp, $res);
    }
}
