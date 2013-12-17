<?php
/**
 * Created by PhpStorm.
 * User: jake
 * Date: 17/12/13
 * Time: 20:20
 */

namespace PndAid\Files;


use PndAid\FileDataIterators\ReverseFileDataIterator;

/**
 * Class FileFactory
 * @package PndAid\Files
 */
class FileFactory
{

    /**
     * return new file object
     * @param string $type type of file object
     * @param string $filePath location of file
     * @return PndFile
     */
    static public function create($type, $filePath)
    {
        if ($type == 'pnd') {
            return new PndFile($filePath, new ReverseFileDataIterator($filePath));
        }
    }

} 