<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class createSockDivTest extends TestCase {
    public function testCreateSockDiv(): void
    {
        // test inputs
        $input = [
            [
                'size' => 'size1',
                'pattern' => 'pattern1',
                'color' => 'color1'
            ],
            [
                'size' => 'size2',
                'pattern' => 'pattern2',
                'color' => 'color2'
            ]
        ];

        // expected result
        $expected =
        "<div class=\"sock\">
        <p>Size: size1</p>
        <p>Pattern: pattern1</p>
        <p>Color: color1</p>
        </div><div class=\"sock\">
        <p>Size: size2</p>
        <p>Pattern: pattern2</p>
        <p>Color: color2</p>
        </div>";

        //actual
        $actual = createSockDiv($input);

        // compare
        $this->assertEquals($expected, $actual);
    }
}