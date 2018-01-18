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
     * @param string      $filename              The filename.
     * @param bool        $isRequired            If true, file is required, false otherwise.
     * @param int         $expectedImageType     The expected image type.
     * @param string      $expectedImageMimeType The expected image mime type.
     * @param int         $expectedImageWidth    The expected image width.
     * @param int         $expectedImageHeight   The expected image height.
     * @param bool        $expectedIsInvalid     True if file is expected to be valid, false otherwise.
     * @param bool        $expectedHasError      True if file field is expected to have an error, false otherwise.
     * @param string|null $expectedError         The expected error or null if no error.
     *
     * @throws \DataTypes\Exceptions\FilePathInvalidArgumentException
     * @throws \InvalidArgumentException
     */
    public function testSetUploadedFile($filename, $isRequired, $expectedImageType, $expectedImageMimeType, $expectedImageWidth, $expectedImageHeight, $expectedIsInvalid, $expectedHasError, $expectedError)
    {
        $imageFileField = new ImageFileField('image');
        $imageFileField->setRequired($isRequired);

        $uploadedFile = $filename !== null ?
            new UploadedFile(FilePath::parse(__DIR__ . '/TestFiles/' . $filename)) :
            null;
        $imageFileField->setUploadedFile($uploadedFile);

        self::assertSame($expectedImageType, $imageFileField->getImageType());
        self::assertSame($expectedImageMimeType, $imageFileField->getImageMimeType());
        self::assertSame($expectedImageWidth, $imageFileField->getImageWidth());
        self::assertSame($expectedImageHeight, $imageFileField->getImageHeight());
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
            [null, false, ImageType::NONE, '', 0, 0, false, false, null],
            [null, true, ImageType::NONE, '', 0, 0, false, true, 'Missing file'],
            ['textfile.txt', true, ImageType::NONE, '', 0, 0, true, true, 'Invalid image file'],
            ['jpegfile.jpg', true, ImageType::JPEG, 'image/jpeg', 20, 30, false, false, null],
        ];
    }
}
