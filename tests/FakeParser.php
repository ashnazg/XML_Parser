<?php
class FakeParser extends XML_Parser {

    private $buffer = null;
    public function getBuffer()
    {
        return $this->buffer;
    }

    public function startHandler($xp, $element, &$attribs) {
        $this->buffer .= "<$element";
        reset($attribs);
        while (list($key, $val) = each($attribs)) {
            $enc = htmlentities($val);
            $this->buffer .= " $key=\"$enc\"";
        }
        $this->buffer .= ">";
    }

    public function endHandler($xp, $element) {
        $this->buffer .= "</$element>\n";
    }

    public function cdataHandler($xp, $cdata) {
        $this->buffer .= "<![CDATA[$cdata]]>";
    }

    public function defaultHandler($xp, $cdata) {

    }
}