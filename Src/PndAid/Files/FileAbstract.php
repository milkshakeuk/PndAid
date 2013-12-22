<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
 */

namespace PndAid\Files;

use PndAid\FileDataIterators\FileDataIteratorAbstract;

/**
 * Class Files
 * @package PndTools\BaseClass
 */
abstract class FileAbstract
{
    /**
     * @var string $filePath
     */
    protected $filePath;
    /**
     * @var FileDataIteratorAbstract $fileIterator
     */
    protected $fileIterator;

    /**
     * Set our file path, verify file exists, instantiate
     * @param $filePath
     * @param FileDataIteratorAbstract $fileIterator
     */
    function __construct($filePath, FileDataIteratorAbstract $fileIterator)
    {
        $this->filePath = $filePath;
        $this->valid();
        $this->fileIterator = $fileIterator;
    }

    /**
     * Verify file exists
     * @throws FileException
     */
    protected function valid()
    {
        if (!file_exists($this->filePath)) {
            throw new FileException("File does not exist! : $this->filePath");
        }
    }

    /**
     * Get the filename
     * @return string
     */
    public function fileName()
    {
        return pathinfo($this->filePath, PATHINFO_BASENAME);
    }

    /**
     * Get the file path
     * @return string
     */
    public function filePath()
    {
        return $this->filePath;
    }

    /**
     * get the file directory
     * @return string
     */
    public function FileDirectory()
    {
        return pathinfo($this->filePath, PATHINFO_DIRNAME);
    }

    /**
     * get the file size
     * @return int
     */
    public function fileSize()
    {
        return filesize($this->filePath);
    }

    /**
     * get the file extension
     * @return string
     */
    public function fileExtension()
    {
        return substr(strrchr($this->filePath, '.'), 1);
    }

    /**
     * Get the file type
     * @return string
     */
    abstract public function fileType();

    /**
     * Locate position of string in a file
     * @param $searchFor string to search for
     * @return int|bool
     */
    public function findInFile($searchFor)
    {
        foreach ($this->fileIterator as $position => $data) {
            if (stripos($data, $searchFor) !== false) {
                return $position + stripos($data, $searchFor);
            }
        }
        return false;
    }

    /**
     * Get the file information extracted from 'file -b <fileName>' command
     * @internal param string $filePath location of file
     * @return string
     */
    public function getFileInfo()
    {
        return shell_exec('file -b ' . $this->filePath);
    }
}