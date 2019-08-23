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
        $histogram = new Histogram();
        $computer = new DiceHistogram2();
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
        $histogram = new Histogram();
        $computer = new DiceHistogram2();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);
        $computer->random();
        $res = $computer->sum();

        $this->assertGreaterThan(1, $res);
    }
    /**
     * Construct object and verify that the object has the expected
     * properties. Correct values.
     */


    public function testCreateGetLastRoll()
    {
        $computer = new Computer();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);

        $computer->random();

        $res = $computer->getLastRoll();

        $this->assertIsInt($res);
    }


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

    public function testCreateObjectCheckNumberSumOver50()
    {
        $computer = new Computer();
        $histogram = new Histogram();
        $computer = new DiceHistogram2();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);
        $_SESSION["allhistogram"] = array(51);
        $res = $computer->CheckNumberSum(2, 2);
        $exp = "Simulate again.";

        $this->assertEquals($exp, $res);
    }

    public function testCreateObjectCheckNumberSumUnder50()
    {
        $computer = new Computer();
        $histogram = new Histogram();
        $computer = new DiceHistogram2();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);
        $_SESSION["allhistogram"] = array(49);
        $res = $computer->CheckNumberSum(2, 2);
        $exp = "Simulate again.";

        $this->assertEquals($exp, $res);
    }

    public function testCreateObjectCheckNumber()
    {
        $computer = new Computer();
        $histogram = new Histogram();
        $computer = new DiceHistogram2();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);
        $_SESSION["allhistogram"] = array(49);
        $res = $computer->CheckNumberSum(2, 2);


        $this->assertIsString($res);
    }
    /**
     * Construct object and verify that the object has the expected
     * properties. Sum under 12(6+6).
     */
    public function testCreateObjectComputer()
    {
        $computer = new Computer();
        $histogram = new Histogram();
        $computer = new DiceHistogram2();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);

        $this->assertIsObject($computer);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Sum under 12(6+6).
     */
    public function testCreateObjectHistogram()
    {
        $computer = new Computer();
        $histogram = new Histogram();
        $computer = new DiceHistogram2();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);

        $this->assertIsObject($histogram);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Sum under 12(6+6).
     */
    public function testCreateObjectHistogram2()
    {
        $computer = new Computer();
        $histogram = new Histogram();
        $computer = new DiceHistogram2();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);

        $this->assertIsObject($computer);
    }
}
