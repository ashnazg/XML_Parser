<?php

class UnitTests extends AbstractUnitTests
{

    private $goodXmlString =
<<<EOF
<?xml version='1.0' ?>
<root>foo</root>
EOF;

    private $goodParseResult =
<<<EOF
<ROOT><![CDATA[foo]]></ROOT>

EOF;

    public function testSimpleProcessingWithFakeParserUsingString()
    {
        $parser = new FakeParser();
        $parser->parseString($this->goodXmlString, true);
        $this->assertEquals($this->goodParseResult, $parser->getBuffer());
    }

    public function testSimpleProcessingWithFakeParserUsingFileName()
    {
        $fh = tmpfile();
        $metadata = stream_get_meta_data($fh);
        $filename = $metadata['uri'];
        file_put_contents($filename, $this->goodXmlString);

        $parser = new FakeParser();
        $parser->setInputFile($filename);
        $parser->parse();
        $this->assertEquals($this->goodParseResult, $parser->getBuffer());
    }

    public function testSimpleProcessingWithFakeParserUsingFileResource()
    {
        $fh = tmpfile();
        fwrite($fh, $this->goodXmlString, strlen($this->goodXmlString));
        rewind($fh);
        $parser = new FakeParser();
        $parser->setInput($fh);
        $parser->parse();
        $this->assertEquals($this->goodParseResult, $parser->getBuffer());
    }

    public function testSimpleProcessingWithFakeParserUsingBadString()
    {
        $parser = new FakeParser();
        $badXml = <<<EOF
<?xml version='1.0' ?>
<root></bar>
EOF;
        $expectedError = 'XML_Parser: Mismatched tag at XML input line 2:13';
        $result = $parser->parseString($badXml, true);
        $this->assertInstanceOf('PEAR_Error', $result);
        $this->assertEquals($expectedError, $result->getMessage());
    }
}