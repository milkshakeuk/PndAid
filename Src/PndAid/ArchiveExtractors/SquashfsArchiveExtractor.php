<?php
/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 19/12/13
 * Time: 00:57
 */

namespace PndAid\ArchiveExtractors;


use PndAid\Files\FileException;

class SquashfsArchiveExtractor extends ArchiveExtractor
{

    /**
     * return array containing list of files in archive
     * @return string[] array of files within the archive
     * @throws \PndAid\Files\FileException
     */
    public function listContents()
    {
        exec("unsquashfs -ll $this->filePath", $output, $status);

        if ($status != 0) {
            throw new FileException('Unsquashfs error: ' . implode(PHP_EOL, $output));
        }
        return preg_filter('/^-.* squashfs-root\/(\w.+)$/', '$1', $output);
    }

    /**
     * Extract file from archive
     * @param string $internalFilePath internal file path within archive
     * @param string $fileDestination
     * @throws \PndAid\Files\FileException
     * @return void
     */
    public function extractFile($internalFilePath, $fileDestination)
    {
        $command = "unsquashfs -d $fileDestination -f $this->filePath \"$internalFilePath\"";
        exec($command, $output, $status);

        if ($status != 0) {
            throw new FileException('Unsquashfs error: ' . implode(PHP_EOL, $output));
        }
    }

    /**
     * Extract the whole archive
     * @param string $fileDestination
     * @throws \PndAid\Files\FileException
     * @return void
     */
    public function extractAll($fileDestination)
    {
        $command = "unsquashfs -d $fileDestination -f $this->filePath";
        exec($command, $output, $status);

        if ($status != 0) {
            throw new FileException('Unsquashfs error: ' . implode(PHP_EOL, $output));
        }
    }
}