<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
 */

namespace PndAid\Files;

use Exception;
use LibXMLError;

class InvalidXmlException extends Exception
{

    /**
     * @var XmlError[] $XmlErrors
     */
    protected $XmlErrors;

    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        $this->transposeErrors(libxml_get_errors());
        parent::__construct($message, $code, $previous);

    }

    /**
     * transpose errors from libXMLError to<br/>
     * XmlError to abstract dependency
     * @param libXMLError[] $errors
     */
    protected function transposeErrors(array $errors)
    {
        $this->XmlErrors = [];
        foreach ($errors as $e) {
            $xmlError = new XmlError($e->column, $e->message, $e->line);
            $this->XmlErrors[] = $xmlError;
        }
        libxml_clear_errors();
    }

    /**
     * Gets the XmlErrors array
     * @return string the Exception message as a string.
     * @return XmlError[] array of XmlError objects
     */
    final public function getXmlErrors()
    {
        return $this->XmlErrors;
    }
} 