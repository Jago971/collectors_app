<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class dropDownOptionsTest extends TestCase {
    public function testDropDownOptionsSuccessTest(): void
    {
        $input = [
            [
                'id' => '1',
                'name' => 'XS'
            ],
            [
                'id' => '2',
                'name' => 'S'
            ],
            [
                'id' => '3',
                'name' => 'M'
            ]
        ];
        $expected = "<option value=\"1\">XS</option><option value=\"2\">S</option><option value=\"3\">M</option>";
        $actual = dropDownOptions($input);
        $this->assertEquals($expected, $actual);
    }

    public function testDropDownOptionsMalformedInputsString(): void
    {
        $input = 'Not an array';
        $this->expectException(TypeError::class);
        dropDownOptions($input);
    }

    public function testDropDownOptionsWrongArrayFormat(): void
    {
        $input = ['an', 'indexed', 'array'];
        $this->expectException(TypeError::class);
        dropDownOptions($input);
    }
}