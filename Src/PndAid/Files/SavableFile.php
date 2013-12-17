<?php
/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 10/12/13
 * Time: 22:41
 */

namespace PndAid\Files;


/**
 * Class SavableFile
 * @package PndTools\Files
 */
abstract class SavableFile
{
    /**
     * @var string $fileData
     */
    protected $fileData;

    /**
     * Set internal parameters
     * @param $fileData
     */
    function __construct($fileData)
    {
        $this->fileData = $fileData;
    }

    /**
     * return file data as string
     * @return string
     */
    function __toString()
    {
        return $this->fileData;
    }

    /**
     * return file data as string
     * @return string
     */
    public function Data()
    {
        return $this->fileData;
    }

    /**
     * Write data to file
     * @param string $filePath location to save file
     */
    abstract public function Save($filePath = null);

} 