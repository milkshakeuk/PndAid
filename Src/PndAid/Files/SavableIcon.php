<?php
/**
 * Created by PhpStorm.
 * User: jake
 * Date: 17/12/13
 * Time: 21:04
 */

namespace PndAid\Files;


/**
 * Class SavableIcon
 * @package PndAid\Files
 */
class SavableIcon extends SavableFile {

    /**
     * Write icon to file
     * @param string $filePath location to save file
     */
    public function Save($filePath = null)
    {
        $filePath = (is_null($filePath))? __DIR__ . '/icon.png' : $filePath;

        $wh = fopen($filePath, 'wb');

        if (flock($wh, LOCK_EX)) {
            fwrite($wh, $this->fileData);
            fflush($wh);
        }
        fclose($wh);
    }
}