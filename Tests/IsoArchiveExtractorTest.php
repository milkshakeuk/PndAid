<?php
use PndAid\ArchiveExtractors\ArchiveExtractor;
use PndAid\ArchiveExtractors\IsoArchiveExtractor;

/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 18/12/13
 * Time: 22:43
 */

class IsoArchiveExtractorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ArchiveExtractor $_isoArchiveExtractor
     */
    protected $_isoArchiveExtractor;

    /**
     * Set up our PndFile instances
     */
    public function setUp()
    {
        $this->_isoArchiveExtractor = new IsoArchiveExtractor(__DIR__ . '/Bump3.pnd');
    }

    /**
     * Check to see if we can return array of files
     */
    public function testListContents()
    {
        $this->assertContains('META-INF/MANIFEST.MF', implode("\n", $this->_isoArchiveExtractor->listContents()));
    }

    /**
     * Check to see if file exists within the archive
     */
    public function testFileInArchive()
    {
        $this->assertTrue($this->_isoArchiveExtractor->fileInArchive('META-INF/MANIFEST.MF'));
    }

    /**
     * Check to see if we can extract a file from the archive
     */
    public function testExtractFile()
    {
        $this->_isoArchiveExtractor->extractFile('META-INF/MANIFEST.MF', __DIR__ . '/Test');
        $this->assertFileExists(__DIR__ . '/Test/META-INF/MANIFEST.MF');
    }

    /**
     * Check to see if we can extract all files from the archive
     */
    public function testExtractAll()
    {
        $this->_isoArchiveExtractor->extractAll(__DIR__ . '/Test');
        $this->assertFileExists(__DIR__ . '/Test/META-INF/MANIFEST.MF');
    }

    /**
     * Test housekeeping
     */
    public static function tearDownAfterClass()
    {
        shell_exec('rm -rf ' . __DIR__ . '/*/');
    }
}
 