<?php
/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 18/12/13
 * Time: 22:43
 */
use PHPUnit\Framework\TestCase;
use PndAid\ArchiveExtractors\ArchiveExtractorAbstract;
use PndAid\ArchiveExtractors\IsoArchiveExtractor;

class IsoArchiveExtractorTest extends TestCase
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
        $this->_squashfsArchiveExtractor = new IsoArchiveExtractor(__DIR__ . '/Bump3.pnd');
    }

    /**
     * Check to see if we can return array of files
     */
    public function testListContents()
    {
        $this->assertContains('META-INF/MANIFEST.MF', implode("\n", $this->_squashfsArchiveExtractor->listContents()));
    }

    /**
     * Check to see if file exists within the archive
     */
    public function testFileInArchive()
    {
        $this->assertTrue($this->_squashfsArchiveExtractor->fileInArchive('META-INF/MANIFEST.MF'));
    }

    /**
     * Check to see if we can extract a file from the archive
     */
    public function testExtractFile()
    {
        $this->_squashfsArchiveExtractor->extractFile('META-INF/MANIFEST.MF', __DIR__ . '/Test');
        $this->assertFileExists(__DIR__ . '/Test/META-INF/MANIFEST.MF');
    }

    /**
     * Check to see if we can extract an array of files from the archive
     */
    public function testExtractFiles()
    {
        $this->_squashfsArchiveExtractor->extractFiles(['bump3/COPYING','bump3/CHANGES'], __DIR__ . '/Test');
        $this->assertFileExists(__DIR__ . '/Test/bump3/COPYING');
        $this->assertFileExists(__DIR__ . '/Test/bump3/CHANGES');
    }

    /**
     * Check to see if we can extract all files from the archive
     */
    public function testExtractAll()
    {
        $this->_squashfsArchiveExtractor->extractAll(__DIR__ . '/Test');
        $this->assertFileExists(__DIR__ . '/Test/META-INF/MANIFEST.MF');
    }

    /**
     * Test housekeeping
     */
    public static function tearDownAfterClass()
    {
        shell_exec('rm -rf ' . __DIR__ . '/Test/');
    }
}
