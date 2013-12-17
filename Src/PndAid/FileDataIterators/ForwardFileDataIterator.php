<?php
/**
 * Created by PhpStorm.
 * User: jake
 * Date: 17/12/13
 * Time: 19:10
 */

namespace PndAid\FileDataIterators;


/**
 * Class ForwardFileDataIterator
 * @package PndAid\FileDataIterators
 */
class ForwardFileDataIterator extends FileDataIterator
{

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid and we are not
     * trying to read beyond the end of the file
     * @return boolean
     */
    public function valid()
    {
        return $this->position < $this->fileSize;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the seek start position
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->seekByteSize = $this->readByteSize;
        $this->position = 0;
        fseek($this->fileHandle, $this->position);
        $this->data = fread($this->fileHandle, $this->readByteSize);
    }

} 