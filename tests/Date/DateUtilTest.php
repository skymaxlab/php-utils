<?php

namespace SkyMaxLab\Date;

use InvalidArgumentException;

class DateUtilTest extends \TestCase
{
    /**
     * @test
     */
    public function get_instance()
    {
        $this->assertInstanceOf(DateUtil::class, new DateUtil());
        $this->assertInstanceOf(DateUtil::class, DateUtil::getInstance());
    }

    /**
     * @test
     */
    public function isDate()
    {
        $this->assertTrue(DateUtil::isDate('2016-01-01'));
        $this->assertTrue(DateUtil::isDate('2016-02-29'));

        $this->assertTrue(DateUtil::isDate('20160101', 'Ymd'));
        $this->assertTrue(DateUtil::isDate('20160229', 'Ymd'));

        $this->assertFalse(DateUtil::isDate('2016-01-40'));
        $this->assertFalse(DateUtil::isDate('0000-01-40'));
    }

    /**
     * @test
     */
    public function range()
    {
        $expected = [
            '2017-01-01',
        ];
        $this->assertEquals($expected, DateUtil::range('2017-01-01', '2017-01-01'));

        $expected = [
            '2017-01-01',
            '2017-01-02',
            '2017-01-03',
            '2017-01-04',
            '2017-01-05',
            '2017-01-06',
        ];
        $this->assertEquals($expected, DateUtil::range('2017-01-01', '2017-01-06'));

        $expected = [
            '20170101',
            '20170102',
            '20170103',
            '20170104',
            '20170105',
            '20170106',
        ];
        $this->assertEquals($expected, DateUtil::range('20170101', '20170106', 'Ymd'));
    }

    /**
     * @test
     */
    public function rangeInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('20170101 is not a valid date in Y-m-d format.');

        DateUtil::range('20170101', '20170102');
    }
}
