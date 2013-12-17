# PndAid

PndAid is a small PHP library to handling and interrogating Pnd files.

## Features

* Get file details (name, path, directory, extension, file size etc.)
* Basic Pnd file validation based on file extension and file type
* Find Pnd archive type (ISO|Squashfs)
* Find and extract the pXML data
* Find and extract the icon data
* Save the pXML to its own file
* Save the icon to its own file
* Ability to iterate over and seek to file data like an array

## Getting Started

### Basic Usage

Instantiate a PndFile:

    $pnd = FileFactory::create('pnd','/path/to/foo.pnd');

Get the archive type:

    $fileType $pnd->fileType();

Get the pXml as a string:

    $pxml = $pnd->Pxml;

Save the pXml to disk:

    $pnd->Pxml->Save('/path/to/pxml.xml');

Get the icon as a string (not much use but still):

    $pxml = $pnd->Icon;

Save the icon to disk:

    $pnd->Icon->Save('/path/to/icon.png');

Iterate over a file

    $fileIterator = new ReverseFileDataIterator('/path/to/file');
    foreach ($fileIterator as $position => $data) {
        if (stripos($data, '<PXML ') !== false) {
            echo 'found at position: ' . $position . ' the data: ' . $data;
        }
    }

### Setup your web server

## Documentation

### Unit Testing

The library is accompanied by passing unit tests. The library uses `phpunit` for testing.

[Learn about PHPUnit](https://github.com/sebastianbergmann/phpunit/)

## Community

This is for the OpenPandora community mainly please check them out.
[Visit the OpenPandora Community](http://boards.openpandora.org/)

### Forum and Knowledge base

Visit the OpenPandora's official forum and knowledge base at <http://boards.openpandora.org/> where you can
chat with OpenPandora users, ask questions, help others, or show off your cool Pandora apps.

## Author

The PndAid library is created and maintained by Jake Aitchison. Jake is a Solutions engineer
[Capita Customer Management](http://www.capitacustomermanagement.co.uk/‎). Jake also created and maintains
[OpenPandora Software Repo](http://repo.openpandora.org/), a software repository written in PHP to enable easy
access to new and great software on the OpenPandora.

## License

The PndAid library is released under the LGPL v2.1 license.

<http://www.gnu.org/licenses/lgpl-2.1.html>