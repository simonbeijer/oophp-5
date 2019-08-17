<?php

namespace Sibj\Game;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    public $serie = [];
    public $serieCounter = [];
    public $serieText = [];
    public $array = [];
    private $min;
    private $max;



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function saveHistogram(array $histogramvalues)
    {
        $this->serieAll = $histogramvalues;
        return $this->serieAll;
    }



    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $string = "";
        for ($i = $this->min; $i <= $this->max; $i++) {
            $string .= $i . ": ";
            foreach ($this->serie as $num) {
                if ($num === $i) {
                    $string .= "*";
                } else $string .= "";
            }
            $string .= "\n";
        }
        if ($string == ": \n") {
            $string = "";
        }
    return $string;

    }

    /**
    * Inject the object to use as base for the histogram data.
    *
    * @param HistogramInterface $object The object holding the serie.
    *
    * @return void.
    */
    public function injectData(HistogramInterface $object)
    {
    $this->serie = $object->getHistogramSerie();
    $this->min   = $object->getHistogramMin();
    $this->max   = $object->getHistogramMax();
    }
}
