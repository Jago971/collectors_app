<?php
require_once 'src/functions.php';

use PHPUnit\Framework\TestCase;

class displaySearchedSockTest extends TestCase {

    public function testDisplaySearchedSockSuccessTest() :void
    {
        $array = [
            'Size' => 'XS',
            'Name' => 'name',
            'Pattern' => 'zigzag',
            'Color' => 'red',
            'Description' => 'description'
        ];
        $int = 1;

        $expected = '<br>';
        $expected .= "<p><b>Size:</b> XS</p>";
        $expected .= "<p><b>Name:</b> name</p>";
        $expected .= "<p><b>Pattern:</b> zigzag</p>";
        $expected .= "<p><b>Color:</b> red</p>";
        $expected .= "<p><b>Description:</b> description</p>";
        $expected .= "<br><form method=\"post\">";
        $expected .= "<label for=\"deletesock\"></label>";
        $expected .= "<input name=\"deletesock\" id=\"deletesock\" value=\"1\">";
        $expected .= "<input class=\"submit\" type=\"submit\" value=\"DELETE SOCK\">";
        $expected .= "</form>";

        $actual = displaySearchedSock($array, $int);
        $this->assertEquals($expected, $actual);
    }

    public function testDisplaySearchedSockNoDescriptionFound() :void
    {
        $array = [
            'Size' => 'XS',
            'Name' => 'name',
            'Pattern' => 'zigzag',
            'Color' => 'red',
            'Description' => ""
        ];
        $int = 1;

        $expected = '<br>';
        $expected .= "<p><b>Size:</b> XS</p>";
        $expected .= "<p><b>Name:</b> name</p>";
        $expected .= "<p><b>Pattern:</b> zigzag</p>";
        $expected .= "<p><b>Color:</b> red</p>";
        $expected .= "<p><b>Description:</b> N/A</p>";
        $expected .= "<br><form method=\"post\">";
        $expected .= "<label for=\"deletesock\"></label>";
        $expected .= "<input name=\"deletesock\" id=\"deletesock\" value=\"1\">";
        $expected .= "<input class=\"submit\" type=\"submit\" value=\"DELETE SOCK\">";
        $expected .= "</form>";

        $actual = displaySearchedSock($array, $int);
        $this->assertEquals($expected, $actual);
    }

    public function testDisplaySearchedSockMissingField() :void
    {
        $array = [
            'Size' => 'XS',
            'Name' => 'name',
            'Pattern' => 'zigzag',
            'Color' => 'red'
        ];
        $int = 1;

        $expected = '<br>';
        $expected .= "<p><b>Size:</b> XS</p>";
        $expected .= "<p><b>Name:</b> name</p>";
        $expected .= "<p><b>Pattern:</b> zigzag</p>";
        $expected .= "<p><b>Color:</b> red</p>";
        $expected .= "<br><form method=\"post\">";
        $expected .= "<label for=\"deletesock\"></label>";
        $expected .= "<input name=\"deletesock\" id=\"deletesock\" value=\"1\">";
        $expected .= "<input class=\"submit\" type=\"submit\" value=\"DELETE SOCK\">";
        $expected .= "</form>";

        $actual = displaySearchedSock($array, $int);
        $this->assertEquals($expected, $actual);
    }

    public function testDisplaySearchedMalformedInt() :void
    {
        $array = [
            'Size' => 'XS',
            'Name' => 'name',
            'Pattern' => 'zigzag',
            'Color' => 'red'
        ];
        $int = 'one';

        $expected = '<br>';
        $expected .= "<p><b>Size:</b> XS</p>";
        $expected .= "<p><b>Name:</b> name</p>";
        $expected .= "<p><b>Pattern:</b> zigzag</p>";
        $expected .= "<p><b>Color:</b> red</p>";
        $expected .= "<br><form method=\"post\">";
        $expected .= "<label for=\"deletesock\"></label>";
        $expected .= "<input name=\"deletesock\" id=\"deletesock\" value=\"1\">";
        $expected .= "<input class=\"submit\" type=\"submit\" value=\"DELETE SOCK\">";
        $expected .= "</form>";

        $this->expectException(TypeError::class);
        createSockDiv($array, $int);
    }

    public function testDisplaySearchedMalformedArray() :void
    {
        $array = 'not an array';
        $int = 1;

        $expected = '<br>';
        $expected .= "<p><b>Size:</b> XS</p>";
        $expected .= "<p><b>Name:</b> name</p>";
        $expected .= "<p><b>Pattern:</b> zigzag</p>";
        $expected .= "<p><b>Color:</b> red</p>";
        $expected .= "<br><form method=\"post\">";
        $expected .= "<label for=\"deletesock\"></label>";
        $expected .= "<input name=\"deletesock\" id=\"deletesock\" value=\"1\">";
        $expected .= "<input class=\"submit\" type=\"submit\" value=\"DELETE SOCK\">";
        $expected .= "</form>";

        $this->expectException(TypeError::class);
        createSockDiv($array, $int);
    }

    public function testDisplaySearchedWrongArrayType() :void
    {
        $array = [1, 2, 3, 4];
        $int = 1;

        $expected = '<br>';
        $expected .= "<p><b>0:</b> 1</p>";
        $expected .= "<p><b>1:</b> 2</p>";
        $expected .= "<p><b>2:</b> 3</p>";
        $expected .= "<p><b>3:</b> 4</p>";
        $expected .= "<br><form method=\"post\">";
        $expected .= "<label for=\"deletesock\"></label>";
        $expected .= "<input name=\"deletesock\" id=\"deletesock\" value=\"1\">";
        $expected .= "<input class=\"submit\" type=\"submit\" value=\"DELETE SOCK\">";
        $expected .= "</form>";

        $actual = displaySearchedSock($array, $int);
        $this->assertEquals($expected, $actual);
    }
}