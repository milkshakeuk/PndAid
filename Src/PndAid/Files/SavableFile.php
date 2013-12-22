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
 * Class SavableFile
 * @package PndAid\Files
 */
class SavableFile implements SavableFileInterface
{
    /**
     * @var string $fileData
     */
    protected $fileData;

    /**
     * return file data as string
     * @return string
     */
    function __toString()
    {
        return $this->fileData;
    }

    /**
     * Write the file and data to disk
     * @param string $filePath where to save
     * @return bool was it saved successfully
     */
    public function save($filePath)
    {
        $wh = fopen($filePath, 'wb');

        if (!$wh) {
            return false;
        }

        if (flock($wh, LOCK_EX)) {
            fwrite($wh, $this->fileData);
            fflush($wh);
        }
        fclose($wh);

        return true;
    }

    /**
     * Set the contents of the file
     * @param string $fileData
     * @return void
     */
    public function setData(&$fileData)
    {
        $this->fileData = $fileData;
    }
}