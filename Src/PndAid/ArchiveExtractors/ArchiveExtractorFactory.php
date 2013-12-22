<?php
/**
 * @package   PndAid
 * @link      https://github.com/milkshakeuk/PndAid
 * @author Jake Aitchison (milkshake) <jake.aitchison@outlook.com>
 * @copyright 2013 Jake Aitchison
 * @license   http://www.gnu.org/licenses/lgpl-2.1.html Distributed under the Lesser General Public License (LGPLv2.1)
 */

namespace PndAid\ArchiveExtractors;


/**
 * Class ArchiveExtractorFactory
 * @package PndAid\Files
 */
class ArchiveExtractorFactory
{

    /**
     * return new ArchiveExtractor object
     * @param string $type type of file object
     * @param string $filePath location of file
     * @return ArchiveExtractorAbstract
     */
    static public function create($type, $filePath)
    {
        if ($type == 'ISO') {
            return new IsoArchiveExtractor($filePath);
        }
        if ($type == 'Squashfs'){
            return new SquashfsArchiveExtractor($filePath);
        }
    }

} 