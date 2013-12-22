<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
 */

namespace PndAid\Files;


/**
 * Class PxmlFacade
 * @package PndAid\Files
 */
class PxmlFacade
{

    /**
     * @var XmlHandler $xmlHandler
     */
    public $xmlHandler;

    /**
     * @var SavableFile $savableFile
     */
    public $savableFile;

    /**
     * Set internal parameters
     * @param $fileData
     * @param $pXmlSchemaPath
     */
    function __construct($fileData, $pXmlSchemaPath)
    {
        $this->xmlHandler = new XmlHandler($fileData, $pXmlSchemaPath);
        $this->savableFile = new SavableFile();
        $this->savableFile->setData($fileData);
    }

    /**
     * Write the file and data to disk
     * @param string $filePath where to save
     * @return bool was it saved successfully
     */
    public function save($filePath)
    {
        $this->savableFile->save($filePath);
    }
    /**
     * Is Pxml Valid against schema?
     * @return bool
     */
    public function isValid()
    {
        return $this->xmlHandler->isXmlValid();
    }
    /**
     * Get Pxml validation errors errors
     * @return XmlError[] array of errors
     */
    public function getPxmlErrors()
    {
        return $this->xmlHandler->getErrors();
    }

    /**
     * Search the xml via xpath string<br/>
     * e.g: //p:previewpics/p:pic/@src
     * @param string $xpathPattern
     * @return \SimpleXMLElement[]
     */
    public function xpathSearch($xpathPattern)
    {
        return $this->xmlHandler->xpathSearch($xpathPattern);
    }

} 