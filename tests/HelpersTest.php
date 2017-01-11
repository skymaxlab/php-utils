<?php

class HelpersTest extends TestCase
{
    public function testUuid()
    {
        // has 36 characters
        $this->assertEquals(36, strlen(uuid()));

        // has 4 '-' characters
        $this->assertEquals(4, substr_count(uuid(), '-'));
    }

    public function testGitHash()
    {
        $hash = git_hash();

        // has 40 characters
        $this->assertEquals(40, strlen($hash));
    }

    public function testGitHashShort()
    {
        $hash = git_hash_short();

        // has 7 characters
        $this->assertEquals(7, strlen($hash));
    }
}
