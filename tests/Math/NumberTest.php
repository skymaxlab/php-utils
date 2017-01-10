<?php

namespace SkyMaxLab\Math;

class NumberTest extends \TestCase
{
    /**
     * @test
     */
    public function can_create_instance()
    {
        $this->assertInstanceOf(Number::class, new Number());
    }

    /**
     * @test
     */
    public function can_add()
    {
        $number = Number::getInstance(.1)->add(.2);
        $this->assertSame(0.3, $number->toFloat());
        $this->assertSame('0.3', $number->toString());
    }

    /**
     * @test
     */
    public function can_subtract()
    {
        $number = Number::getInstance(.1)->subtract(.2);
        $this->assertSame(-0.1, $number->toFloat());
        $this->assertSame('-0.1', $number->toString());
    }

    /**
     * @test
     */
    public function can_mutiply()
    {
        $number = Number::getInstance(.1)->multiply(.2);
        $this->assertSame(0.02, $number->toFloat());
        $this->assertSame('0.02', $number->toString());
    }

    /**
     * @test
     */
    public function can_divide()
    {
        $number = Number::getInstance(.1)->divide(.2);
        $this->assertSame(0.5, $number->toFloat());
        $this->assertSame('0.5', $number->toString());
    }
}
