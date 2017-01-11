<?php

namespace SkyMaxLab\Math;

class Number
{
    const DEFAULT_SCALE = 10;

    protected $number;

    protected $scale;

    /**
     * Number constructor.
     *
     * @param int $number
     * @param int $scale
     */
    public function __construct($number = 0, $scale = Number::DEFAULT_SCALE)
    {
        $this->number = $number;
        $this->scale = $scale;
    }

    /**$scale
     * @param int $number
     * @param int $scale
     * @return Number
     */
    public static function getInstance($number = 0, $scale = Number::DEFAULT_SCALE)
    {
        return new Number($number, $scale);
    }

    /**
     * @param $number
     *
     * @return $this
     */
    public function add($number)
    {
        $this->number = bcadd($this->number, $number, $this->scale);

        return $this;
    }

    /**
     * @param $number
     *
     * @return $this
     */
    public function subtract($number)
    {
        $this->number = bcsub($this->number, $number, $this->scale);

        return $this;
    }

    /**
     * @param $number
     *
     * @return $this
     */
    public function multiply($number)
    {
        $this->number = bcmul($this->number, $number, $this->scale);

        return $this;
    }

    /**
     * @param $number
     *
     * @return $this
     */
    public function divide($number)
    {
        $this->number = bcdiv($this->number, $number, $this->scale);

        return $this;
    }

    /**
     * @return float
     */
    public function toFloat()
    {
        return (float)$this->number;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return (string)$this->toFloat();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    // wrapper functions

    /**
     * @param $left
     * @param $right
     * @param int $scale
     *
     * @return string
     */
    public static function bcadd($left, $right, $scale = Number::DEFAULT_SCALE)
    {
        return bcadd($left, $right, $scale);
    }

    /**
     * @param $left
     * @param $right
     * @param int $scale
     *
     * @return string
     */
    public static function bcsub($left, $right, $scale = Number::DEFAULT_SCALE)
    {
        return bcsub($left, $right, $scale);
    }

    /**
     * @param $left
     * @param $right
     * @param int $scale
     *
     * @return string
     */
    public static function bcmul($left, $right, $scale = Number::DEFAULT_SCALE)
    {
        return bcmul($left, $right, $scale);
    }

    /**
     * @param $left
     * @param $right
     * @param int $scale
     *
     * @return string
     */
    public static function bcdiv($left, $right, $scale = Number::DEFAULT_SCALE)
    {
        return bcdiv($left, $right, $scale);
    }
}
