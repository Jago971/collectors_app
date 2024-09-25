<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class createSockDivTest extends TestCase {
    public function testCreateSockDivSuccessTest(): void
    {
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

        $expected = "<div class=\"sock-BG flex\">
                <div class=\"sock-container size1 color1\">
                      <div class=\"sock-ankle\">
                            <div class=\"cuff detail\"></div>
                            <div class=\"heel\"></div>
                      </div>
                      <div class=\"sock-foot\">
                            <div class=\"toe\"></div>
                      </div>
                </div>
                <div class=\"description flex\">
                    <h3>name1</h3>
                    <div class=\"description-container\"><p>description1</p><p class=\"cover\">...</p></div>
                </div>
            </div><div class=\"sock-BG flex\">
                <div class=\"sock-container size2 color2\">
                      <div class=\"sock-ankle\">
                            <div class=\"cuff detail\"></div>
                            <div class=\"heel\"></div>
                      </div>
                      <div class=\"sock-foot\">
                            <div class=\"toe\"></div>
                      </div>
                </div>
                <div class=\"description flex\">
                    <h3>name2</h3>
                    <div class=\"description-container\"><p>description2</p><p class=\"cover\">...</p></div>
                </div>
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