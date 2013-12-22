<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
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
            return new PndFile($filePath, new ReverseFileDataIterator($filePath), __DIR__ . '/schema.xsd');
        }
    }

} 