<?php

declare(strict_types=1);

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
     * @param string|null $filename                          The filename or null if no file.
     * @param bool        $isRequired                        If true, file is required, false otherwise.
     * @param int         $expectedImageType                 The expected image type.
     * @param string      $expectedImageMimeType             The expected image mime type.
     * @param string      $expectedImageDefaultFileExtension The expected image default file extension.
     * @param int         $expectedImageWidth                The expected image width.
     * @param int         $expectedImageHeight               The expected image height.
     * @param bool        $expectedIsInvalid                 True if file is expected to be valid, false otherwise.
     * @param bool        $expectedHasError                  True if file field is expected to have an error, false otherwise.
     * @param string|null $expectedError                     The expected error or null if no error.
     */
    public function testSetUploadedFile(?string $filename, bool $isRequired, int $expectedImageType, string $expectedImageMimeType, string $expectedImageDefaultFileExtension, int $expectedImageWidth, int $expectedImageHeight, bool $expectedIsInvalid, bool $expectedHasError, ?string $expectedError)
    {
        $imageFileField = new ImageFileField('image');
        $imageFileField->setRequired($isRequired);

        $uploadedFile = $filename !== null ?
            new UploadedFile(FilePath::parse(__DIR__ . '/TestFiles/' . $filename)) :
            null;
        $imageFileField->setUploadedFile($uploadedFile);

        $imageWidth = 0;
        $imageHeight = 0;
        $image = $imageFileField->getImage();

        if ($image !== null) {
            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);
            imagedestroy($image);
        }

        self::assertSame($expectedImageType, $imageFileField->getImageType());
        self::assertSame($expectedImageMimeType, $imageFileField->getImageMimeType());
        self::assertSame($expectedImageDefaultFileExtension, $imageFileField->getImageDefaultFileExtension());
        self::assertSame($expectedImageWidth, $imageFileField->getImageWidth());
        self::assertSame($expectedImageHeight, $imageFileField->getImageHeight());
        self::assertSame($expectedIsInvalid, $imageFileField->isInvalid());
        self::assertSame($expectedHasError, $imageFileField->hasError());
        self::assertSame($expectedError, $imageFileField->getError());
        self::assertSame($expectedImageWidth, $imageWidth);
        self::assertSame($expectedImageHeight, $imageHeight);
    }

    /**
     * Data provider for set uploaded file test.
     *
     * @return array
     */
    public function setUploadedFileDataProvider()
    {
        return [
            [null, false, ImageType::NONE, '', '', 0, 0, false, false, null],
            [null, true, ImageType::NONE, '', '', 0, 0, false, true, 'Missing file'],
            ['textfile.txt', true, ImageType::NONE, '', '', 0, 0, true, true, 'Invalid image file'],
            ['jpegfile.jpg', true, ImageType::JPEG, 'image/jpeg', 'jpg', 20, 30, false, false, null],
            ['pngfile.png', true, ImageType::PNG, 'image/png', 'png', 25, 25, false, false, null],
            ['giffile.gif', true, ImageType::GIF, 'image/gif', 'gif', 25, 40, false, false, null],
        ];
    }
}
