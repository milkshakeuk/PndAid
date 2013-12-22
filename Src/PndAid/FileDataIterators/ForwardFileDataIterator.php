<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
 */

namespace PndAid\FileDataIterators;


/**
 * Class ForwardFileDataIterator
 * @package PndAid\FileDataIterators
 */
class ForwardFileDataIterator extends FileDataIteratorAbstract
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