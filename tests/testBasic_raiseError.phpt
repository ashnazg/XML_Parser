--TEST--
XML_Util::raiseError() basic tests
--CREDITS--
Chuck Burgess <ashnazg@php.net>
# created for v1.2.0a1 2008-05-04
--FILE--
<?php
require_once 'XML' . DIRECTORY_SEPARATOR . 'Util.php';

$error = XML_Util::raiseError("I am an error", 12345);
if (is_a($error, 'PEAR_Error')) {
    print "PEAR Error: " . $error->getMessage() . PHP_EOL;
}
?>
--EXPECT--
PEAR Error: I am an error
