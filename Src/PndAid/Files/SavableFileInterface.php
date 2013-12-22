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
 * Interface SavableFileInterface
 * @package PndAid\Files
 */
interface SavableFileInterface
{
    /**
     * Set the contents of the file
     * @param string $fileData
     * @return void
     */
    public function setData(&$fileData);

    /**
     * Write the file and data to disk
     * @param string $filePath where to save
     * @return bool was it saved successfully
     */
    public function save($filePath);
} 