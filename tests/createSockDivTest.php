<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class createSockDivTest extends TestCase {
    public function testCreateSockDivSuccessTest(): void
    {
        $input = [
            [
                'size' => 1,
                'name' => 'name',
                'pattern' => 1,
                'color' => 1,
                'description' => 'description'
            ]
        ];
        $sizes = [
            [
                'id'=>1,
                'name'=>'XS'
            ]
        ];
        $patterns = [
            ['id'=>1,
            'name'=>'zigzag']
        ];
        $colors = [
            ['id'=>1,
            'name'=>'yellow']
        ];

        $expected = '';
        $expected .= "<div class=\"sock-BG flex\">";
        $expected .= "<div class=\"sock-container XS yellow\">";
        $expected .= "<div class=\"sock-ankle zigzag\">";
        $expected .= "<div class=\"cuff detail\"></div>";
        $expected .= "<div class=\"heel\"></div>";
        $expected .= "</div>";
        $expected .= "<div class=\"sock-foot zigzag\">";
        $expected .= "<div class=\"toe\"></div>";
        $expected .= "</div>";
        $expected .= "</div>";
        $expected .= "<div class=\"description flex\">";
        $expected .= "<h3>name</h3>";
        $expected .= "<div class=\"description-container\"><p>description</p><p class=\"cover\">...</p></div>";
        $expected .= "</div>";
        $expected .= "</div>";

        $actual = createSockDiv($input, $sizes, $patterns, $colors);
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

    public function testCreateSockDivMissingDescription(): void
    {
        $input = [
            [
                'size' => 1,
                'name' => 'name',
                'pattern' => 1,
                'color' => 1
            ]
        ];
        $sizes = [
            [
                'id'=>1,
                'name'=>'XS'
            ]
        ];
        $patterns = [
            ['id'=>1,
                'name'=>'zigzag']
        ];
        $colors = [
            ['id'=>1,
                'name'=>'yellow']
        ];

        $expected = '';
        $expected .= "<div class=\"sock-BG flex\">";
        $expected .= "<div class=\"sock-container XS yellow\">";
        $expected .= "<div class=\"sock-ankle zigzag\">";
        $expected .= "<div class=\"cuff detail\"></div>";
        $expected .= "<div class=\"heel\"></div>";
        $expected .= "</div>";
        $expected .= "<div class=\"sock-foot zigzag\">";
        $expected .= "<div class=\"toe\"></div>";
        $expected .= "</div>";
        $expected .= "</div>";
        $expected .= "<div class=\"description flex\">";
        $expected .= "<h3>name</h3>";
        $expected .= "<div class=\"description-container\"><p></p><p class=\"cover\">...</p></div>";
        $expected .= "</div>";
        $expected .= "</div>";

        $actual = createSockDiv($input, $sizes, $patterns, $colors);
        $this->assertEquals($expected, $actual);
    }
    public function testCreateSockDivMissingField(): void
    {
        $input = [
            [
                'size' => 1,
                'name' => 'name',
                'pattern' => 1,
                'color' => 1,
                'description' => 'description'
            ]
        ];
        $sizes = [
            [
                'id'=>1,
                'name'=>'XS'
            ]
        ];
        $patterns = [
            ['id'=>1,
                'name'=>'zigzag']
        ];

        $expected = '';
        $expected .= "<div class=\"sock-BG flex\">";
        $expected .= "<div class=\"sock-container XS yellow\">";
        $expected .= "<div class=\"sock-ankle zigzag\">";
        $expected .= "<div class=\"cuff detail\"></div>";
        $expected .= "<div class=\"heel\"></div>";
        $expected .= "</div>";
        $expected .= "<div class=\"sock-foot zigzag\">";
        $expected .= "<div class=\"toe\"></div>";
        $expected .= "</div>";
        $expected .= "</div>";
        $expected .= "<div class=\"description flex\">";
        $expected .= "<h3>name</h3>";
        $expected .= "<div class=\"description-container\"><p>description</p><p class=\"cover\">...</p></div>";
        $expected .= "</div>";
        $expected .= "</div>";

        $this->expectException(ArgumentCountError::class);
        createSockDiv($input, $sizes, $patterns);
    }
    public function testCreateSockDivFieldWrongDataType(): void
    {
        $input = [
            [
                'size' => 1,
                'name' => 'name',
                'pattern' => 1,
                'color' => 1,
                'description' => 'description'
            ]
        ];
        $sizes = [
            [
                'id'=>1,
                'name'=>'XS'
            ]
        ];
        $patterns = [
            ['id'=>1,
                'name'=>'zigzag']
        ];
        $colors = 'wrong data type';

        $expected = '';
        $expected .= "<div class=\"sock-BG flex\">";
        $expected .= "<div class=\"sock-container XS yellow\">";
        $expected .= "<div class=\"sock-ankle zigzag\">";
        $expected .= "<div class=\"cuff detail\"></div>";
        $expected .= "<div class=\"heel\"></div>";
        $expected .= "</div>";
        $expected .= "<div class=\"sock-foot zigzag\">";
        $expected .= "<div class=\"toe\"></div>";
        $expected .= "</div>";
        $expected .= "</div>";
        $expected .= "<div class=\"description flex\">";
        $expected .= "<h3>name</h3>";
        $expected .= "<div class=\"description-container\"><p>description</p><p class=\"cover\">...</p></div>";
        $expected .= "</div>";
        $expected .= "</div>";

        $this->expectException(TypeError::class);
        createSockDiv($input, $sizes, $patterns, $colors);
    }
}