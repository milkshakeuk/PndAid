<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
 */

namespace PndAid\FileDataIterators;

use PndAid\Files\FileException;
use SeekableIterator;


/**
 * Class FileDataIterator
 * @package PndAid\FileDataIterators
 */
abstract class FileDataIteratorAbstract implements SeekableIterator
{

    /**
     * @var int $fileSize
     */
    protected $fileSize;
    /**
     * @var resource $fileHandle
     */
    protected $fileHandle;
    /**
     * @var int $position
     */
    protected $position;
    /**
     * @var string $data
     */
    protected $data;
    /**
     * @var int $readByteSize
     */
    protected $readByteSize;
    /**
     * @var int $seekByteSize
     */
    protected $seekByteSize;

    /**
     * @param string $filePath
     * @param int $seekByteSize
     * @throws \PndAid\Files\FileException
     */
    function __construct($filePath, $seekByteSize = 1000)
    {
        if (!file_exists($filePath)) {
            throw new FileException("Files does not exist! : $filePath");
        }

        if (!$this->fileHandle = fopen($filePath, 'rb')) {
            throw new FileException("Couldn't open file \"" . $filePath . "\"");
        }

        $this->fileSize = filesize($filePath);
        $this->readByteSize = $seekByteSize;

    }

    /**
     * return specific section of file by providing byte start and end positions
     * @param int $sectionStartPos start position of section
     * @param int $sectionEndPos end position of section
     * @return string
     */
    public function getFileSection($sectionStartPos, $sectionEndPos)
    {
        fseek($this->fileHandle, $sectionStartPos);
        $sectionData = fread($this->fileHandle, $sectionEndPos - $sectionStartPos);

        return $sectionData;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current segment of data
     * @return string
     */
    public function current()
    {
        return $this->data;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next segment of data
     * @return void
     */
    public function next()
    {
        $this->position += $this->seekByteSize;
        if ($this->valid()) {
            fseek($this->fileHandle, $this->position);
            $this->data = fread($this->fileHandle, $this->readByteSize * 2);
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid and we are not
     * trying to read beyond the end of the file
     * @return boolean
     */
    abstract public function valid();

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current position in the file
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the seek start position
     * @return void Any returned value is ignored.
     */
    abstract public function rewind();

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Seeks to a position in the file
     * @param int $position <p>
     * The position to seek to.
     * </p>
     * @return void
     */
    public function seek($position)
    {
        $this->position = $position;
        if ($this->valid()) {
            fseek($this->fileHandle, $position);
            $this->data = fread($this->fileHandle, $this->readByteSize);
        }
    }
}