<?php
use PndAid\ArchiveExtractors\ArchiveExtractorAbstract;
use PndAid\ArchiveExtractors\SquashfsArchiveExtractor;

/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 18/12/13
 * Time: 22:43
 */

class SquashfsArchiveExtractorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ArchiveExtractorAbstract $_isoArchiveExtractor
     */
    protected $_squashfsArchiveExtractor;

    /**
     * Set up our PndFile instances
     */
    public function setUp()
    {
        $this->_squashfsArchiveExtractor = new SquashfsArchiveExtractor(__DIR__ . '/abbaye.pnd');
    }

    /**
     * Check to see if we can return array of files
     */
    public function testListContents()
    {
        $this->assertContains('abbaye-title.png', implode("\n", $this->_squashfsArchiveExtractor->listContents()));
    }

    /**
     * Check to see if file exists within the archive
     */
    public function testFileInArchive()
    {
        $this->assertTrue($this->_squashfsArchiveExtractor->fileInArchive('abbaye-title.png'));
    }

    /**
     * Check to see if we can extract a file from the archive
     */
    public function testExtractFile()
    {
        $this->_squashfsArchiveExtractor->extractFile('abbaye-title.png', __DIR__ . '/Test');
        $this->assertFileExists(__DIR__ . '/Test/abbaye-title.png');
    }

    /**
     * Check to see if we can extract an array of files from the archive
     */
    public function testExtractFiles()
    {
        $this->_squashfsArchiveExtractor->extractFiles(['abbaye.png','abbaye.sh'], __DIR__ . '/Test');
        $this->assertFileExists(__DIR__ . '/Test/abbaye.png');
        $this->assertFileExists(__DIR__ . '/Test/abbaye.sh');
    }

    /**
     * Check to see if we can extract all files from the archive
     */
    public function testExtractAll()
    {
        $this->_squashfsArchiveExtractor->extractAll(__DIR__ . '/Test');
        $this->assertFileExists(__DIR__ . '/Test/abbaye-title.png');
    }

    /**
     * Test housekeeping
     */
    public static function tearDownAfterClass()
    {
        shell_exec('rm -rf ' . __DIR__ . '/Test/');
    }
}
 