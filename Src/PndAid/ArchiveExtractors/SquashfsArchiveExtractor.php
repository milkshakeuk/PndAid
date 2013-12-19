<?php
/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 19/12/13
 * Time: 00:57
 */

namespace PndAid\ArchiveExtractors;


use PndAid\Files\FileException;

class SquashfsArchiveExtractor extends ArchiveExtractor {

    /**
     * return array containing list of files in archive
     * @return string[] array of files within the archive
     */
    public function listContents()
    {
        // TODO: Implement listContents() method.
    }

    /**
     * Extract file from archive
     * @param string $filePath internal file path within archive
     * @param string $fileDestination
     * @return void
     */
    public function extractFile($filePath, $fileDestination)
    {
        // TODO: Implement extractFile() method.
    }

    /**
     * Extract the whole archive
     * @param string $fileDestination
     * @return void
     */
    public function extractAll($fileDestination)
    {
        // TODO: Implement extractAll() method.
    }
}