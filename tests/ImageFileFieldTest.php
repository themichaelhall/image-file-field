<?php

namespace MichaelHall\ImageFileField\Tests;

use BlueMvc\Core\UploadedFile;
use DataTypes\FilePath;
use MichaelHall\ImageFileField\ImageFileField;
use PHPUnit\Framework\TestCase;

/**
 * Test ImageFileField class.
 */
class ImageFileFieldTest extends TestCase
{
    /**
     * Test setUploadedFile method.
     *
     * @dataProvider setUploadedFileDataProvider
     *
     * @param string      $filename          The filename.
     * @param bool        $isRequired        If true, file is required, false otherwise.
     * @param bool        $expectedIsInvalid True if file is expected to be valid, false otherwise.
     * @param bool        $expectedHasError  True if file field is expected to have an error, false otherwise.
     * @param string|null $expectedError     The expected error or null if no error.
     */
    public function testSetUploadedFile($filename, $isRequired, $expectedIsInvalid, $expectedHasError, $expectedError)
    {
        $imageFileField = new ImageFileField('image');
        $imageFileField->setRequired($isRequired);

        $uploadedFile = $filename !== null ?
            new UploadedFile(FilePath::parse(__DIR__ . '/TestFiles/' . $filename)) :
            null;
        $imageFileField->setUploadedFile($uploadedFile);

        self::assertSame($expectedIsInvalid, $imageFileField->isInvalid());
        self::assertSame($expectedIsInvalid ? null : $uploadedFile, $imageFileField->getValue());
        self::assertSame($expectedHasError, $imageFileField->hasError());
        self::assertSame($expectedError, $imageFileField->getError());
    }

    /**
     * Data provider for set uploaded file test.
     *
     * @return array
     */
    public function setUploadedFileDataProvider()
    {
        return [
            [null, false, false, false, null],
            [null, true, false, true, 'Missing file'],
            ['textfile.txt', true, false, false, null],
        ];
    }
}
