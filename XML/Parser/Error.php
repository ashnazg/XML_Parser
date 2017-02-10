<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * XML_Parser
 *
 * XML Parser's Error class
 *
 * PHP versions 4 and 5
 *
 * LICENSE:
 *
 * Copyright (c) 2002-2008 The PHP Group
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *    * Redistributions of source code must retain the above copyright
 *      notice, this list of conditions and the following disclaimer.
 *    * Redistributions in binary form must reproduce the above copyright
 *      notice, this list of conditions and the following disclaimer in the
 *      documentation and/or other materials provided with the distribution.
 *    * The name of the author may not be used to endorse or promote products
 *      derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY
 * OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  XML
 * @package   XML_Parser
 * @author    Stig Bakken <ssb@fast.no>
 * @author    Tomas V.V.Cox <cox@idecnet.com>
 * @author    Stephan Schmidt <schst@php.net>
 * @copyright 2002-2008 The PHP Group
 * @license   http://opensource.org/licenses/bsd-license New BSD License
 * @version   CVS: $Id$
 * @link      http://pear.php.net/package/XML_Parser
 */

/**
 * error class, replaces PEAR_Error
 *
 * An instance of this class will be returned
 * if an error occurs inside XML_Parser.
 *
 * There are three advantages over using the standard PEAR_Error:
 * - All messages will be prefixed
 * - check for XML_Parser error, using is_a( $error, 'XML_Parser_Error' )
 * - messages can be generated from the xml_parser resource
 *
 * @category  XML
 * @package   XML_Parser
 * @author    Stig Bakken <ssb@fast.no>
 * @author    Tomas V.V.Cox <cox@idecnet.com>
 * @author    Stephan Schmidt <schst@php.net>
 * @copyright 2002-2008 The PHP Group
 * @license   http://opensource.org/licenses/bsd-license New BSD License
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/XML_Parser
 * @see       PEAR_Error
 */
class XML_Parser_Error extends PEAR_Error
{
    // {{{ properties

    /**
    * prefix for all messages
    *
    * @var      string
    */
    var $error_message_prefix = 'XML_Parser: ';

    // }}}
    // {{{ constructor()
    /**
    * construct a new error instance
    *
    * You may either pass a message or an xml_parser resource as first
    * parameter. If a resource has been passed, the last error that
    * happened will be retrieved and returned.
    *
    * @param string|resource $msgorparser message or parser resource
    * @param integer         $code        error code
    * @param integer         $mode        error handling
    * @param integer         $level       error level
    *
    * @access   public
    * @todo PEAR CS - can't meet 85char line limit without arg refactoring
    */
    function __construct($msgorparser = 'unknown error', $code = 0, $mode = PEAR_ERROR_RETURN, $level = E_USER_NOTICE)
    {
        if (is_resource($msgorparser)) {
            $code        = xml_get_error_code($msgorparser);
            $msgorparser = sprintf('%s at XML input line %d:%d',
                xml_error_string($code),
                xml_get_current_line_number($msgorparser),
                xml_get_current_column_number($msgorparser));
        }
        parent::__construct($msgorparser, $code, $mode, $level);
    }
    // }}}

    /**
     * PHP4 constructor for backwards compatibility with older code
     *
     * @param string|resource $msgorparser message or parser resource
     * @param integer         $code        error code
     * @param integer         $mode        error handling
     * @param integer         $level       error level
     */
    function XML_Parser_Error($msgorparser = 'unknown error', $code = 0, $mode = PEAR_ERROR_RETURN, $level = E_USER_NOTICE)
    {
        self::__construct($msgorparser, $code, $mode, $level);
    }
}
?>
