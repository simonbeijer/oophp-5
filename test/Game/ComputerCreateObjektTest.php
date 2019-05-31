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
     * properties. Use no arguments.
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
     * properties. Use no arguments.
     */
    public function testCreateObjectSumGreater()
    {
        $computer = new Computer();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);
        $computer->random();
        $res = $computer->sum();

        $this->assertGreaterThan(1, $res);
    }

    // public function testCreateObjectValues()
    // {
    //     $computer = new Computer();
    //     $this->assertInstanceOf("\Sibj\Game\Game", $computer);
    //     $res = $computer->random();
    //
    //     $this->assertIsArray($res);
    // }
    //
    // public function testCreateObjectScore()
    // {
    //     $computer = new Computer();
    //     $this->assertInstanceOf("\Sibj\Game\Game", $computer);
    //     $computer->random();
    //     $res = $computer->score();
    //
    //     $this->assertIsArray($computer);
    // }
    //
    public function testCreateObjectAddScore()
    {
        $computer = new Computer();
        $this->assertInstanceOf("\Sibj\Game\Game", $computer);
        $computer->random();
        $exp = $computer->score();
        $res = $computer->addScore(42);

        $this->assertEquals($exp, $res);
    }
}
// {
//     /**
//      * Construct object and verify that the object has the expected
//      * properties. Use no arguments.
//      */
//     public function testCreateObjectNoArguments()
//     {
//         $computer = new Computer();
//         $this->assertInstanceOf("\Sibj\Game\Game", $computer);
//
//         $res = $computer->random();
//
//     }
//
//     /**
//      * Construct object and verify that the object has the expected
//      * properties. Use no arguments.
//      */
//     public function testCreateObjectSumLess()
//     {
//         $computer = new Computer();
//         $this->assertInstanceOf("\Sibj\Game\Game", $computer);
//         $computer->random();
//         $res = $computer->sum();
//
//         $this->assertLessThan(13, $res);
//
//     }
//
//     /**
//      * Construct object and verify that the object has the expected
//      * properties. Use no arguments.
//      */
//     public function testCreateObjectSumGreater()
//     {
//         $computer = new Computer();
//         $this->assertInstanceOf("\Sibj\Game\Game", $computer);
//         $computer->random();
//         $res = $computer->sum();
//
//         $this->assertGreaterThan(1, $res);
// }


    //
    //
    // /**
    //  * Construct object and verify that the object has the expected
    //  * properties. Use only first argument.
    //  */
    // public function testCreateObjectFirstArgument()
    // {
    //     $guess = new Game(42);
    //     $this->assertInstanceOf("\Mos\Game\Game", $guess);
    //
    //     $res = $guess->tries();
    //     $exp = 6;
    //     $this->assertEquals($exp, $res);
    //
    //     $res = $guess->number();
    //     $exp = 42;
    //     $this->assertEquals($exp, $res);
    // }
    //
    //
    //
    // /**
    //  * Construct object and verify that the object has the expected
    //  * properties. Use both arguments.
    //  */
    // public function testCreateObjectBothArguments()
    // {
    //     $guess = new Game(42, 7);
    //     $this->assertInstanceOf("\Mos\Game\Game", $guess);
    //
    //     $res = $guess->tries();
    //     $exp = 7;
    //     $this->assertEquals($exp, $res);
    //
    //     $res = $guess->number();
    //     $exp = 42;
    //     $this->assertEquals($exp, $res);
    // }
    //
    //
    // /**
    //  * Test if there is and out put on right number.
    //  */
    // public function testIfGameRight()
    // {
    //     $guess = new Game(42);
    //     $this->assertInstanceOf("\Mos\Game\Game", $guess);
    //
    //     $res = $guess->makeGame(42);
    //     $exp = "correct!!!";
    //     $this->assertEquals($exp, $res);
    // }
    //
    // /**
    //  * Test if there is and out put on high number.
    //  */
    // public function testIfGameHigh()
    // {
    //     $guess = new Game(41);
    //     $this->assertInstanceOf("\Mos\Game\Game", $guess);
    //
    //     $res = $guess->makeGame(42);
    //     $exp = "to high...";
    //     $this->assertEquals($exp, $res);
    // }
    //
    // /**
    //  * Test if there is and out put on low number.
    //  */
    // public function testIfGameLow()
    // {
    //     $guess = new Game(43);
    //     $this->assertInstanceOf("\Mos\Game\Game", $guess);
    //
    //     $res = $guess->makeGame(42);
    //     $exp = "to low...";
    //     $this->assertEquals($exp, $res);
    // }
    //
    // /**
    //  * Test if there is and out put no more tries.
    //  */
    // public function testIfNoMoreTries()
    // {
    //     $guess = new Game(42, 0);
    //     $this->assertInstanceOf("\Mos\Game\Game", $guess);
    //
    //     $res = $guess->makeGame(5);
    //     $exp = "no guesses left.";
    //     $this->assertEquals($exp, $res);
    // }
    //
    // /**
    //  * Test if there is a exception if guess exception.
    //  */
    // public function testIfGameException()
    // {
    //     $guess = new Game(101);
    //     $this->assertInstanceOf("\Mos\Game\Game", $guess);
    // }
    //
    // /**
    //  * Test if there is and out put on out of bounce number.
    //  * @expectedException \Exception
    //  */
    // public function testIfGameOutOfBounce()
    // {
    //     $guess = new Game(42);
    //     $this->assertInstanceOf("\Mos\Game\Game", $guess);
    //
    //     $guess->makeGame(101);
    //     $this->expectExceptionMessage("Your guess is out of bounds.");
    // }
// }
