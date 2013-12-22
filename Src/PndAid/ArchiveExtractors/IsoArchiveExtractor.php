<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
 */

namespace PndAid\ArchiveExtractors;


use PndAid\Files\FileException;

class IsoArchiveExtractor extends ArchiveExtractorAbstract
{

    /**
     * return array containing list of files in archive
     * @return string[] array of files within the archive
     * @throws \PndAid\Files\FileException
     */
    public function listContents()
    {
        exec("7z l $this->filePath", $output, $status);

        if ($status != 0) {
            throw new FileException('7z error: ' . implode(PHP_EOL, $output));
        }
        return preg_filter('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2} \.{5}.*  (\w.+)$/', '$1', $output);
    }


    /**
     * Extract file from archive (file structure is preserved)
     * @param string $internalFilePath internal file path within archive
     * @param string $fileDestination
     * @throws \PndAid\Files\FileException
     * @return void
     */
    public function extractFile($internalFilePath, $fileDestination)
    {
        $command = "7z x $this->filePath -i!$internalFilePath -o$fileDestination -ssc- -aos";
        exec($command, $output, $status);

        if ($status != 0 || !$this->fileInArchive($internalFilePath)) {
            throw new FileException('7z error: ' . implode(PHP_EOL, $output));
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
        $command = "7z x $this->filePath -o$fileDestination -ssc- -aos";
        exec($command, $output, $status);

        if ($status != 0) {
            throw new FileException('7z error: ' . implode(PHP_EOL, $output));
        }
    }
}