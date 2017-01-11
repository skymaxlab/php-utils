<?php

namespace SkyMaxLab\Traits;

class HasEnumsTest extends \TestCase
{
    public function testAllEnums()
    {
        $expected = [
            'TYPE_ADMIN' => 'admin',
            'TYPE_ROOT' => 'root',
            'TYPE_USER' => 'user',
            'COLOR_RED' => 'red',
            'COLOR_ORANGE' => 'orange',
            'COLOR_YELLOW' => 'yellow',
        ];
        $enums = HasEnumsClass::enums();
        $this->assertSame($expected, $enums);
    }

    public function testTypeEnums()
    {
        $expected = [
            'TYPE_ADMIN' => 'admin',
            'TYPE_ROOT' => 'root',
            'TYPE_USER' => 'user',
        ];
        $enums = HasEnumsClass::enums('TYPE');
        $this->assertSame($expected, $enums);

        $expected = [
            'COLOR_RED' => 'red',
            'COLOR_ORANGE' => 'orange',
            'COLOR_YELLOW' => 'yellow',
        ];
        $enums = HasEnumsClass::enums('COLOR');
        $this->assertSame($expected, $enums);
    }

    public function testIsValidEnumValue()
    {
        $this->assertTrue(HasEnumsClass::isValidEnumValue('admin'));
        $this->assertTrue(HasEnumsClass::isValidEnumValue('root'));
        $this->assertTrue(HasEnumsClass::isValidEnumValue('user'));

        $this->assertFalse(HasEnumsClass::isValidEnumValue('123456'));
        $this->assertFalse(HasEnumsClass::isValidEnumValue('abc'));
        $this->assertFalse(HasEnumsClass::isValidEnumValue('hello'));
    }

    public function testIsValidEnumKey()
    {
        $this->assertTrue(HasEnumsClass::isValidEnumKey('TYPE_ADMIN'));
        $this->assertTrue(HasEnumsClass::isValidEnumKey('TYPE_ROOT'));
        $this->assertTrue(HasEnumsClass::isValidEnumKey('TYPE_USER'));

        $this->assertFalse(HasEnumsClass::isValidEnumKey('NEW_KEY'));
        $this->assertFalse(HasEnumsClass::isValidEnumKey('RANDOM'));
        $this->assertFalse(HasEnumsClass::isValidEnumKey('TYPE_MAN'));
    }
}

class HasEnumsClass
{
    use HasEnums;

    const TYPE_ADMIN = 'admin';
    const TYPE_ROOT = 'root';
    const TYPE_USER = 'user';

    const COLOR_RED = 'red';
    const COLOR_ORANGE = 'orange';
    const COLOR_YELLOW = 'yellow';
}
