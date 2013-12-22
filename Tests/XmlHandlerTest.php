<?php
use PndAid\Files\XmlHandler;

/**
 * Created by PhpStorm.
 * User: jake
 * Date: 20/12/13
 * Time: 13:28
 */

class XmlHandlerTest extends PHPUnit_Framework_TestCase {

    protected $xmlHandler;

    public function setUp()
    {
        $fileData = file_get_contents(__DIR__ . '/invalidPxml.xml');
        $schemaLocation = __DIR__ . '/../Src/PndAid/Files/schema.xsd';
        $this->xmlHandler = new XmlHandler($fileData, $schemaLocation);
    }

    /**
     * test our xml validator works
     */
    public function testIsXmlValid()
    {
        $this->assertFalse($this->xmlHandler->isXmlValid());
    }

    /**
     * test we can return errors on false validation
     */
    public function testGetErrors()
    {
        $this->xmlHandler->isXmlValid();
        $this->assertNotEmpty($this->xmlHandler->getErrors());
    }

    /**
     * test we can find things in the xml
     */
    public function testXpathSearch()
    {
        $this->assertNotEmpty($this->xmlHandler->xPathSearch('//p:previewpics/p:pic/@src'));
    }
}
 