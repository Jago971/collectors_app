<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class dropDownOptionsTest extends TestCase {
    public function testDropDownOptionsSuccessTest(): void
    {
        // test inputs
        $input = [
            [1 => 'XS'],
            [2 => 'S'],
            [3 => 'M']
        ];

        $expected = "<option value=\"XS\">XS</option><option value=\"S\">S</option><option value=\"M\">M</option>";

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

        $expected = '';

        $actual = dropDownOptions($input);

        $this->assertEquals($expected, $actual);
    }

}