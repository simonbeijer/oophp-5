<?php

namespace Sibj\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class HistogramCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectHistogram()
    {
        $histogram = new Histogram();

        $this->assertInstanceOf("\Sibj\Game\Histogram", $histogram);

        $res = $histogram->getAsText();
        $this->assertIsString($res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Sum under 12(6+6).
     */
    public function testHistogramSerie()
    {
        $histogram = new Histogram();

        $this->assertInstanceOf("\Sibj\Game\Histogram", $histogram);

        $res = $histogram->getSerie();
        $this->assertIsArray($res);
    }

    public function testHistogramSaveHistogram()
    {
        $histogram = new Histogram();

        $this->assertInstanceOf("\Sibj\Game\Histogram", $histogram);

        $res = $histogram->saveHistogram("123456");
        $this->assertIsArray($res);
    }

    public function testHistogram2Max()
    {
        $game = new DiceHistogram2();

        $this->assertInstanceOf("\Sibj\Game\DiceHistogram2", $game);

        $res = $game->getHistogramMax();
        $this->assertIsInt($res);
    }

    public function testHistogram2Rolls()
    {
        $game = new DiceHistogram2();

        $this->assertInstanceOf("\Sibj\Game\DiceHistogram2", $game);

        $res = $game->rolls();
        $this->assertIsArray($res);
    }

    public function testHistogram2Roll()
    {
        $game = new DiceHistogram2();

        $this->assertInstanceOf("\Sibj\Game\DiceHistogram2", $game);

        $res = $game->roll();
        $this->assertIsInt($res);
    }

    public function testHistogramTraitSerie()
    {
        $game = new DiceHistogram2();

        $this->assertInstanceOf("\Sibj\Game\DiceHistogram2", $game);

        $res = $game->getHistogramSerie();
        $this->assertIsArray($res);
    }

    public function testHistogramTraitMin()
    {
        $game = new DiceHistogram2();

        $this->assertInstanceOf("\Sibj\Game\DiceHistogram2", $game);

        $res = $game->getHistogramMin();
        $this->assertIsInt($res);
    }

    public function testHistogramTraitMax()
    {
        $game = new DiceHistogram2();

        $this->assertInstanceOf("\Sibj\Game\DiceHistogram2", $game);

        $res = $game->getHistogramMax();
        $this->assertIsInt($res);
    }
}
