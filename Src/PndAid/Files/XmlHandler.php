<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
 */

namespace PndAid\Files;


use DOMDocument;
use SimpleXMLElement;

/**
 * Class XmlHandler
 * @package PndAid\Files
 */
class XmlHandler
{

    /**
     * @var DOMDocument $xmlDoc
     */
    protected $xmlDoc;
    /**
     * @var SimpleXMLElement $sXml
     */
    protected $sXml;
    /**
     * @var string $pXmlSchemaLocation
     */
    protected $pXmlSchemaPath;
    /**
     * @var string $fileData
     */
    protected $fileData;

    /**
     * @param string $fileData pxml string
     * @param string $pXmlSchemaPath
     * @throws InvalidXmlException
     */
    function __construct(&$fileData, $pXmlSchemaPath)
    {
        $this->fileData = $fileData;
        $this->verifyWellFormedXml();
        $this->pXmlSchemaPath = $pXmlSchemaPath;
        $this->xmlDoc = new DOMDocument();
        $this->xmlDoc->loadXML($fileData);
    }

    /**
     * Check if the xmlData is well formed
     * @throws InvalidXmlException if it is not
     */
    protected function verifyWellFormedXml()
    {
        libxml_use_internal_errors(true);
        $this->sXml = simplexml_load_string($this->fileData);

        if (!$this->sXml) {
            throw new InvalidXmlException("XML Error!");
        }
    }

    /**
     * Is Xml Valid against schema?
     * @return bool
     */
    public function isXmlValid()
    {
        return $this->xmlDoc->schemaValidate($this->pXmlSchemaPath);
    }

    /**
     * transpose errors from libXMLError to<br/>
     * XmlError to abstract dependency
     * @return XmlError[] array of errors
     */
    public function getErrors()
    {
        $XmlErrors = [];
        foreach (libxml_get_errors() as $e) {
            $xmlError = new XmlError($e->column, $e->message, $e->line);
            $XmlErrors[] = $xmlError;
        }
        libxml_clear_errors();

        return $XmlErrors;
    }

    /**
     * Search the xml via xpath string
     * @param string $xpathPattern
     * @return \SimpleXMLElement[]
     */
    public function xpathSearch($xpathPattern)
    {
        //xpath wont search pxml without registering the PXML xmlns namespace
        //so to make it work we register the namespace with our SimpleXMLElement
        //and remember to append the namespace in our searches i.e. //p:previewpics/p:pic/@src
        $this->sXml->registerXPathNamespace("p", "http://openpandora.org/namespaces/PXML");
        return $this->sXml->xpath($xpathPattern);
    }
} 