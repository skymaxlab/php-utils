<?php

class HelpersTest extends TestCase
{
    public function testUuid()
    {
        // has 36 characters
        $this->assertSame(36, strlen(uuid()));

        // has 4 '-' characters
        $this->assertSame(4, substr_count(uuid(), '-'));
    }
}
