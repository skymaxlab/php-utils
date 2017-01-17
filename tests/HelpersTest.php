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

    public function testGitHash()
    {
        $hash = git_hash();

        // has 40 characters
        $this->assertSame(40, strlen($hash));
    }

    public function testGitHashShort()
    {
        $hash = git_hash_short();

        // has 7 characters
        $this->assertSame(7, strlen($hash));
    }

    public function testVarExportShort()
    {
        $data = [
            'user_id' => 1
        ];
        $expected = "[
  'user_id' => 1,
]";
        $this->assertSame($expected, var_export_short($data));

        $data = [
            [
                'user_id' => 1,
                'name' => 'one',
            ],
            [
                'user_id' => 2,
                'name' => 'two',
            ],
        ];
        $expected = "[
  0 => 
  [
    'user_id' => 1,
    'name' => 'one',
  ],
  1 => 
  [
    'user_id' => 2,
    'name' => 'two',
  ],
]";
        $this->assertSame($expected, var_export_short($data));
    }
}
