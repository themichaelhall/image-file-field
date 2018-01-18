<?php

namespace MichaelHall\ImageFileField\Tests;

use BlueMvc\Core\UploadedFile;
use DataTypes\FilePath;
use MichaelHall\ImageFileField\ImageFileField;
use MichaelHall\ImageFileField\ImageType;
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
     * @param int         $expectedImageType The expected image type.
     * @param bool        $expectedIsInvalid True if file is expected to be valid, false otherwise.
     * @param bool        $expectedHasError  True if file field is expected to have an error, false otherwise.
     * @param string|null $expectedError     The expected error or null if no error.
     */
    public function testSetUploadedFile($filename, $isRequired, $expectedImageType, $expectedIsInvalid, $expectedHasError, $expectedError)
    {
        $imageFileField = new ImageFileField('image');
        $imageFileField->setRequired($isRequired);

        $uploadedFile = $filename !== null ?
            new UploadedFile(FilePath::parse(__DIR__ . '/TestFiles/' . $filename)) :
            null;
        $imageFileField->setUploadedFile($uploadedFile);

        self::assertSame($expectedImageType, $imageFileField->getImageType());
        self::assertSame($expectedIsInvalid, $imageFileField->isInvalid());
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
            [null, false, ImageType::NONE, false, false, null],
            [null, true, ImageType::NONE, false, true, 'Missing file'],
            ['textfile.txt', true, ImageType::NONE, true, true, 'Invalid image file'],
            ['jpegfile.jpg', true, ImageType::JPEG, false, false, null],
        ];
    }
}
