# PndAid

PndAid is a small PHP library for handling and interrogating Pnd files.

## Features

* Get file details (name, path, directory, extension, file size etc.)
* Basic Pnd file validation based on file extension and file type
* Find Pnd archive type (ISO|Squashfs)
* Find and extract the pXML data
* Find and extract the icon data
* Save the pXML to its own file
* Save the icon to its own file
* Ability to iterate over and seek to file data like an array
* Ability to list files in archive
* Ability to extract files from both pnd archive formats (ISO|Squashfs)

## Getting Started

### Basic Usage

Instantiate a PndFile:
```PHP
$pnd = FileFactory::create('pnd','/path/to/foo.pnd');
```
Get the archive type:
```PHP
$fileType = $pnd->fileType();
```
Get the pXml as a string:
```PHP
$pxml = $pnd->Pxml->Data();
```
Save the pXml to disk:
```PHP
$pnd->Pxml->Save('/path/to/pxml.xml');
```
Get the icon as a string (not much use but still):
```PHP
$pxml = $pnd->Icon->Data();
```
Save the icon to disk:
```PHP
$pnd->Icon->Save('/path/to/icon.png');
```
Find the position of something in the pnd binary
```PHP
$position = $pnd->findInFile('<package ');
```
Or Iterate over any file for any reason
```PHP
$fileIterator = new ReverseFileDataIterator('/path/to/file');
foreach ($fileIterator as $position => $data) {
    if (stripos($data, '<PXML ') !== false) {
        echo 'found at position: ' . $position + stripos($data, '<PXML ');
    }
}
```
Extract file from iso archive (requires 7z being installed on your environment)
```PHP
$Extractor = new IsoArchiveExtractor('/path/to/foo.pnd');
$Extractor->extractFile('META-INF/MANIFEST.MF', '/dir/to/extract/to');
```
Extract file from squashfs archive (requires squashfs-tools being installed on your environment)
```PHP
$Extractor = new SquashfsArchiveExtractor('/path/to/foo.pnd');
$Extractor->extractFile('META-INF/MANIFEST.MF', '/dir/to/extract/to');
```
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
