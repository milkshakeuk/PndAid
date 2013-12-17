<?php
/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 09/12/13
 * Time: 14:58
 */

namespace PndAid\Files;

use PndAid\FileDataIterators\FileDataIterator;
use RuntimeException;

/**
 * Class Files
 * @package PndTools\BaseClass
 */
abstract class File
{
    /**
     * @var string $filePath
     */
    protected $filePath;
    /**
     * @var FileDataIterator $fileIterator
     */
    protected $fileIterator;

    /**
     * Set our file path, verify file exists, instantiate
     * @param $filePath
     * @param FileDataIterator $fileIterator
     */
    function __construct($filePath, FileDataIterator $fileIterator)
    {
        $this->filePath = $filePath;
        $this->valid();
        $this->fileIterator = $fileIterator;
    }

    /**
     * Verify file exists
     * @throws \RuntimeException
     */
    protected function valid()
    {
        if (!file_exists($this->filePath)) {
            throw new RuntimeException("File does not exist! : $this->filePath");
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