<?php
/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 19/12/13
 * Time: 10:35
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
     * @return ArchiveExtractor
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