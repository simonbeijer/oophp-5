<?php
//
namespace Sibj\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class ComputerCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $computer = new Computer();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);

        $res = $computer->random();
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Sum under 12(6+6).
     */
    public function testCreateObjectSumLess()
    {
        $computer = new Computer();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);
        $computer->random();
        $res = $computer->sum();

        $this->assertLessThan(13, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Sum over 1 (1+1).
     */
    public function testCreateObjectSumGreater()
    {
        $computer = new Computer();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);
        $computer->random();
        $res = $computer->sum();

        $this->assertGreaterThan(1, $res);
    }
    /**
     * Construct object and verify that the object has the expected
     * properties. Correct values.
     */

    public function testCreateObjectValues()
    {
        $computer = new Computer(4, 2);
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);

        $res = $computer->values();
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Correct addScore.
     */

    public function testCreateObjectAddScore()
    {
        $computer = new Computer();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);
        $computer->random();
        $exp = $computer->score();
        $res = $computer->addScore(42);

        $this->assertEquals($exp, $res);
    }
    /**
     * Construct object and verify that the object has the expected
     * properties. CheckNumberSum.
     */

    public function testCreateObjectCheckNumberSum()
    {
        $computer = new Computer();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);

        $res = $computer->CheckNumberSum(1, 2);
        $exp = "Computer lost its points, your turn to throw.";

        $this->assertEquals($exp, $res);
    }
}
