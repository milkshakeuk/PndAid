<?php
/**
 * Created by PhpStorm.
 * User: Jake Aitchison
 * Date: 16/12/13
 * Time: 16:01
 */

use PndAid\Files\FileFactory;
use PndAid\Files\PndFile;

/**
 * Class PndFileTest
 * @package PndAid\Files
 */
class PndFileTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PndFile $_pndFileIso
     */
    protected $_pndFileIso;
    /**
     * @var PndFile $_pndFileSqa
     */
    protected $_pndFileSqa;

    /**
     * Set up our PndFile instances
     */
    public function setUp()
    {
        $this->_pndFileIso = FileFactory::create('pnd', __DIR__ . '/Bump3.pnd');
        $this->_pndFileSqa = FileFactory::create('pnd',__DIR__ . '/abbaye.pnd');
    }

    /**
     * Test the getFileInfo method which calls the linux command "file -b <filename>"
     */
    public function testGetFileInfo()
    {
        $expectedValue = 'Squashfs filesystem, little endian, version 4.0, 352032 bytes, 235 inodes, blocksize: 131072 bytes, created: Sun Jan 27 19:26:15 2013' . PHP_EOL;
        $this->assertEquals($expectedValue, $this->_pndFileSqa->getFileInfo());
    }

    /**
     * Test getting the file extension
     */
    public function testFileExtension()
    {
        $this->assertEquals('pnd', $this->_pndFileIso->fileExtension());
    }

    /**
     * Test getting the file type for ISO pnd
     */
    public function testFileTypeIso()
    {
        $this->assertEquals('ISO', $this->_pndFileIso->filetype());
    }

    /**
     * Test getting the file type for Squashfs pnd
     */
    public function testFileTypeSqa()
    {
        $this->assertEquals('Squashfs', $this->_pndFileSqa->filetype());
    }

    /**
     * Test saving pxml to file from pnd
     */
    public function testSavePXmlIso()
    {
        $this->_pndFileIso->Pxml->Save($this->_pndFileIso->filePath() . '.pxml.xml');
        $this->assertFileExists($this->_pndFileIso->filePath() . '.pxml.xml');
    }

    /**
     * Test saving icon to file from pnd
     */
    public function testSaveIconIso()
    {
        $this->_pndFileIso->Icon->Save($this->_pndFileIso->filePath() . '.icon.png');
        $this->assertFileExists($this->_pndFileIso->filePath() . '.icon.png');
    }

    /**
     * @expectedException PndAid\Files\FileException
     */
    public function testPndFileThrowsFileException()
    {
        $pndFile = FileFactory::create('pnd',__DIR__ . '/foo.pnd');
    }

    /**
     * @expectedException PndAid\Files\InvalidPndException
     */
    public function testPndFileThrowsInvalidPndException()
    {
        $pndFile = FileFactory::create('pnd',__DIR__ . '/bar.pnd');
    }

}
 