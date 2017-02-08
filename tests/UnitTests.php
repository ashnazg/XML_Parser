<?php

class UnitTests extends AbstractUnitTests
{

    public function testSimpleProcessingWithFakeParserUsingString()
    {
        $parser = new FakeParser();
        $original = <<<EOF
<?xml version='1.0' ?>
<root>foo</root>
EOF;
        $parser->parseString($original, true);
        $expected = <<<EOF
<ROOT><![CDATA[foo]]></ROOT>

EOF;
        $this->assertEquals($expected, $parser->getBuffer());
    }

    public function testSimpleProcessingWithFakeParserUsingFileName()
    {
        $parser = new FakeParser();
        $parser->setInputFile(__DIR__ . '/test2.xml');
        $parser->parse();
        $expected = <<<EOF
<ROOT><![CDATA[foo]]></ROOT>

EOF;
        $this->assertEquals($expected, $parser->getBuffer());
    }

    public function testSimpleProcessingWithFakeParserUsingFileResource()
    {
        $parser = new FakeParser();
        $fp = fopen(__DIR__ . "/test3.xml", "r");
        $parser->setInput($fp);
        $parser->parse();
        $expected = <<<EOF
<ROOT><![CDATA[foo]]></ROOT>

EOF;
        $this->assertEquals($expected, $parser->getBuffer());
    }

    public function testSimpleProcessingWithFakeParserUsingBadString()
    {
        $parser = new FakeParser();
        $original = <<<EOF
<?xml version='1.0' ?>
<root></bar>
EOF;
        $expectedError = 'XML_Parser: Mismatched tag at XML input line 2:13';
        $result = $parser->parseString($original, true);
        $this->assertInstanceOf('PEAR_Error', $result);
        $this->assertEquals($expectedError, $result->getMessage());
    }
}