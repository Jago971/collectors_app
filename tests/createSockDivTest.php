<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class createSockDivTest extends TestCase {
    public function testCreateSockDivSuccessTest(): void
    {
        // test inputs
        $input = [
            [
                'name' => 'name1',
                'size' => 'size1',
                'pattern' => 'pattern1',
                'color' => 'color1',
                'description' => 'description1'
            ],
            [
                'name' => 'name2',
                'size' => 'size2',
                'pattern' => 'pattern2',
                'color' => 'color2',
                'description' => 'description2'
            ]
        ];

        $expected = "<div class=\"sock\">
        <p>Name: name1</p>
        <p>Size: size1</p>
        <p>Pattern: pattern1</p>
        <p>Color: color1</p>
        <p>Description: description1</p>
        </div><div class=\"sock\">
        <p>Name: name2</p>
        <p>Size: size2</p>
        <p>Pattern: pattern2</p>
        <p>Color: color2</p>
        <p>Description: description2</p>
        </div>";

        $actual = createSockDiv($input);

        $this->assertEquals($expected, $actual);
    }

    public function testCreateSockDivMalformedInputsTest(): void
    {
        $inputA = 'Not an array';

        $this->expectException(TypeError::class);

        createSockDiv($inputA);
    }

    public function testCreateSockDivWrongArrayFormatTest(): void
    {
        $input = ['Not', 'an', 'array'];

        $this->expectException(TypeError::class);

        createSockDiv($input);
    }
}