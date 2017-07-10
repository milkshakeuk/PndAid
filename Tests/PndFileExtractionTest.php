<?php
/**
 * Created by PhpStorm.
 * User: jake
 * Date: 19/12/13
 * Time: 23:50
 */
use PHPUnit\Framework\TestCase;
use PndAid\Files\FileFactory;
use PndAid\Files\PndFile;

class PndFileExtractionTest extends TestCase {
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
        $this->_pndFileSqa = FileFactory::create('pnd', __DIR__ . '/abbaye.pnd');
    }
    /**
     * preview pics in pXml don't exist in archive
     * @expectedException PndAid\Files\FileException
     */
    public function testExtractPreviewPicsIso(){
        $this->_pndFileIso->extractPreviewPics(__DIR__ . '/TestPics');
    }

    /**
     * Test preview pics are extracted ok
     */
    public function testExtractPreviewPicsSqa(){
        $this->_pndFileSqa->extractPreviewPics(__DIR__ . '/TestPics');
        $this->assertTrue(file_exists(__DIR__ . '/TestPics/abbaye-preview.png'));
        $this->assertTrue(file_exists(__DIR__ . '/TestPics/abbaye-preview-md.png'));
        $this->assertTrue(file_exists(__DIR__ . '/TestPics/abbaye-preview-md2.png'));
        $this->assertTrue(file_exists(__DIR__ . '/TestPics/abbaye-title.png'));
    }
    /**
     * Test housekeeping
     */
    public static function tearDownAfterClass()
    {
        shell_exec('rm -rf ' . __DIR__ . '/TestPics/');
    }
}
