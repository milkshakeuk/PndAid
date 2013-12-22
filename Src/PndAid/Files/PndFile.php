<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
 */

namespace PndAid\Files;

use PndAid\ArchiveExtractors\ArchiveExtractorAbstract;
use PndAid\ArchiveExtractors\ArchiveExtractorFactory;
use PndAid\FileDataIterators\FileDataIteratorAbstract;

/**
 * Class PndFile
 * @package PndAid\Files
 */
class PndFile extends FileAbstract
{

    /**
     * @var SavableFile $Icon
     */
    public $icon;
    /**
     * @var SavableFile $Pxml
     */
    public $pxml;
    /**
     * @var ArchiveExtractorAbstract $archiveExtractor
     */
    protected $archiveExtractor;

    /**
     * @param string $filePath
     * @param FileDataIteratorAbstract $fileIterator
     * @param string $pXmlSchemaPath location of pXml schema
     */
    function __construct($filePath, FileDataIteratorAbstract $fileIterator, $pXmlSchemaPath)
    {
        parent::__construct($filePath, $fileIterator);
        $this->pxml = new PxmlFacade($this->_getPXmlData(), $pXmlSchemaPath);
        $this->icon = new SavableFile($this->_getIconData());
        $this->archiveExtractor = ArchiveExtractorFactory::create($this->fileType(), $filePath);
    }

    /**
     * Get pXml Data from the end of pnd file
     * @return string
     */
    protected function _getPXmlData()
    {
        list($pXmlStartPos, $pXmlEndPos) = $this->_getPXmlPosition();

        //add length of PXML end back on to binary position
        $pXmlEndPos += strlen("</PXML>");

        $pXmlData = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL
            . $this->fileIterator->getFileSection($pXmlStartPos, $pXmlEndPos);

        return $pXmlData;
    }

    /**
     * Get start and end Byte position where PXML is located
     * @throws InvalidPndException
     * @return array
     */
    protected function _getPXmlPosition()
    {
        $pXmlStartPos = $this->findInFile("<PXML");
        $pXmlEndPos = $this->findInFile("</PXML>");

        if ($pXmlStartPos === false || $pXmlEndPos === false) {
            throw new InvalidPndException("pXml is missing or incomplete");
        }

        return [$pXmlStartPos, $pXmlEndPos];
    }

    /**
     * returns icon data
     * @return string
     */
    protected function _getIconData()
    {
        return $this->fileIterator->getFileSection($this->_getIconStartPosition(),
            $this->fileSize());
    }

    /**
     * returns position start position of icon
     * @throws InvalidPndException
     * @return int
     */
    protected function _getIconStartPosition()
    {
        $pngMagicNumber = chr(0x89) . chr(0x50) . chr(0x4e) . chr(0x47)
            . chr(0x0d) . chr(0x0a) . chr(0x1a) . chr(0x0a);

        $iconStartPos = $this->findInFile($pngMagicNumber);

        if ($iconStartPos === false) {
            throw new InvalidPndException('Icon is missing from end of file!');
        }

        return $iconStartPos;
    }

    /**
     * get pnd file type
     * @return string
     */
    public function fileType()
    {
        return (preg_match('/\b(Squashfs|ISO)\b/', $this->getFileInfo(), $matched) == 1) ? $matched[0] : "";
    }

    /**
     * Save preview pictures to disk
     * @param string $dirToSaveTo
     */
    public function extractPreviewPics($dirToSaveTo)
    {
        $previewPics = array_map(function ($val) {
            return (string)$val;
        }, $this->pxml->xpathSearch('//p:previewpics/p:pic/@src'));

        $this->archiveExtractor->extractFiles($previewPics, $dirToSaveTo);
    }

    /**
     * Verify exists and is a valid pnd file
     * @throws InvalidPndException
     */
    protected function valid()
    {
        if (!file_exists($this->filePath)) {
            throw new FileException("Files does not exist! : $this->filePath");
        }
        if (!$this->_isValidFileType()) {
            throw new InvalidPndException("Files provided is not of type ISO or Squashfs!");
        }
        if (!$this->_isValidFileExtension()) {
            throw new InvalidPndException("Files provided has invalid extension!");
        }
    }

    /**
     * Confirm whether file is ISO or Squashfs
     * @return bool
     */
    protected function _isValidFileType()
    {
        $fileType = $this->fileType();
        return ($fileType == "ISO" || $fileType == "Squashfs");
    }

    /**
     * check if pnd file has valid extension
     * @return int
     */
    protected function _isValidFileExtension()
    {
        return (strcasecmp($this->fileExtension(), 'pnd') == 0);
    }

}
