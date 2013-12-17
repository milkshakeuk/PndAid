<?php
/**
 * Created by PhpStorm.
 * User: jake
 * Date: 17/12/13
 * Time: 20:59
 */

namespace PndAid\Files;


/**
 * Class SavablePxml
 * @package PndAid\Files
 */
class SavablePxml extends SavableFile {

    /**
     * Save pxmnl to file
     * @param string $filePath
     */
    public function Save($filePath = null)
    {
        $filePath = (is_null($filePath))? __DIR__ . '/PXML.xml' : $filePath;

        $wh = fopen($filePath, 'wb');

        if (flock($wh, LOCK_EX)) {
            fwrite($wh, $this->fileData);
            fflush($wh);
        }
        fclose($wh);
    }

} 