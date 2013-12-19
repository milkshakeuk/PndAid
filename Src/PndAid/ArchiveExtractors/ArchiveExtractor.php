<?php
/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 18/12/13
 * Time: 19:24
 */

namespace PndAid\ArchiveExtractors;


use PndAid\Files\FileException;

/**
 * Class ArchiveExtractors
 * @package PndAid\ArchiveExtractors
 */
abstract class ArchiveExtractor
{

    /**
     * @var string $filePath location of file
     */
    protected $filePath;

    /**
     * @param string $filePath location of file
     * @throws \PndAid\Files\FileException
     */
    public function __construct($filePath)
    {
        if (!file_exists($filePath)) {
            throw new FileException("Files does not exist! : $filePath");
        }

        $this->filePath = $filePath;
    }

    /**
     * return array containing list of files in archive
     * @return string[] array of files within the archive
     */
    abstract public function listContents();

    /**
     * Check if file exists in the file archive
     * @param string $fileName name of file to find
     * @return bool
     */
    public function fileInArchive($fileName)
    {
        foreach ($this->listContents() as $file) {
            if (stripos($file, $fileName) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * extract list of files from archive
     * @param string[] $filePathList
     * @param string $fileDestination
     * @return void
     */
    public function extractFiles($filePathList, $fileDestination)
    {
        foreach ($filePathList as $file) {
            $this->extractFile($file, $fileDestination);
        }
    }

    /**
     * Extract file from archive
     * @param string $internalFilePath internal file path within archive
     * @param string $fileDestination
     * @return void
     */
    abstract public function extractFile($internalFilePath, $fileDestination);

    /**
     * Extract the whole archive
     * @param string $fileDestination
     * @return void
     */
    abstract public function extractAll($fileDestination);

}