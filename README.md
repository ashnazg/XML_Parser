# XML_Parser - XML parsing class based on PHP's bundled expat

[![Build Status](https://travis-ci.org/pear/XML_Parser.svg?branch=master)](https://travis-ci.org/pear/XML_Parser)
    

This is an XML parser based on PHPs built-in xml extension.
It supports two basic modes of operation: "func" and "event". In "func" mode, it will look for a function named after each element (xmltag_ELEMENT for start tags and xmltag_ELEMENT_ for end tags), and in "event" mode it uses a set of generic callbacks.

[Homepage](http://pear.php.net/package/XML_Parser/)


## Installation
For a PEAR installation that downloads from the PEAR channel:

`$ pear install pear/xml_parser`

For a PEAR installation from a previously downloaded tarball:

`$ pear install XML_Parser-*.tgz`

For a PEAR installation from a code clone:

`$ pear install package.xml`

For a local composer installation:

`$ composer install`

To add as a dependency to your composer-managed application:

`$composer require pear/xml_parser`


## Tests
Run  the tests from a local composer installation:

`$ ./vendor/bin/phpunit`


## License
BSD license
