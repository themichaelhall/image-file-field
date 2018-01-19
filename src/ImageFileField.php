<?php
/**
 * This file is a part of the image-file-field package.
 *
 * Read more at https://github.com/themichaelhall/image-file-field
 */

namespace MichaelHall\ImageFileField;

use BlueMvc\Core\Interfaces\UploadedFileInterface;
use BlueMvc\Forms\FileField;
use MichaelHall\ImageFileField\Interfaces\ImageFileFieldInterface;

/**
 * Image file field class.
 *
 * @since 1.0.0
 */
class ImageFileField extends FileField implements ImageFileFieldInterface
{
    /**
     * Constructs the image file field.
     *
     * @since 1.0.0
     *
     * @param string $name The name.
     *
     * @throws \InvalidArgumentException If the $name parameter is not a string.
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->myReset();
    }

    /**
     * Returns the image resource, for the image file or null if no valid image is uploaded.
     *
     * @since 1.0.0
     *
     * @return resource|null The image resource for the image file or null.
     */
    public function getImage()
    {
        if ($this->isEmpty()) {
            return null;
        }

        $filePath = $this->getFile()->getPath()->__toString();

        switch ($this->myImageType) {
            case ImageType::JPEG:
                return imagecreatefromjpeg($filePath) ?: null;
            case ImageType::PNG:
                return imagecreatefrompng($filePath) ?: null;
        }

        return null;
    }

    /**
     * Returns the image default file extension.
     *
     * @since 1.0.0
     *
     * @return string The image default file extension.
     */
    public function getImageDefaultFileExtension()
    {
        return $this->myImageDefaultFileExtension;
    }

    /**
     * Returns the image height.
     *
     * @since 1.0.0
     *
     * @return int The image height.
     */
    public function getImageHeight()
    {
        return $this->myImageHeight;
    }

    /**
     * Returns the image mime type.
     *
     * @since 1.0.0
     *
     * @return string The image mime type.
     */
    public function getImageMimeType()
    {
        return $this->myImageMimeType;
    }

    /**
     * Returns the image type as one of the constants defined in the ImageType class.
     *
     * @since 1.0.0
     *
     * @return int The image type.
     */
    public function getImageType()
    {
        return $this->myImageType;
    }

    /**
     * Returns the image width.
     *
     * @since 1.0.0
     *
     * @return int The image width.
     */
    public function getImageWidth()
    {
        return $this->myImageWidth;
    }

    /**
     * Return true if the image file is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the image file is invalid, false otherwise.
     */
    public function isInvalid()
    {
        return $this->myIsInvalid;
    }

    /**
     * Called when uploaded file is set from form.
     *
     * @since 1.0.0
     *
     * @param UploadedFileInterface|null $uploadedFile The file from form.
     */
    protected function onSetUploadedFile(UploadedFileInterface $uploadedFile = null)
    {
        parent::onSetUploadedFile($uploadedFile);

        $this->myReset();

        if ($this->hasError()) {
            return;
        }

        if ($this->isEmpty()) {
            return;
        }

        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = strtolower(finfo_file($fileInfo, $uploadedFile->getPath()));

        if (!isset(self::$myImageTypes[$mimeType])) {
            $this->myIsInvalid = true;
            $this->setError('Invalid image file');

            return;
        }

        $imageType = self::$myImageTypes[$mimeType];

        $this->myImageMimeType = $mimeType;
        $this->myImageType = $imageType[0];
        $this->myImageDefaultFileExtension = $imageType[1];

        $imageSize = getimagesize($uploadedFile->getPath());
        $this->myImageWidth = $imageSize[0];
        $this->myImageHeight = $imageSize[1];
    }

    /**
     * Resets the properties.
     */
    private function myReset()
    {
        $this->myIsInvalid = false;
        $this->myImageType = ImageType::NONE;
        $this->myImageHeight = 0;
        $this->myImageWidth = 0;
        $this->myImageMimeType = '';
        $this->myImageDefaultFileExtension = '';
    }

    /**
     * @var bool True if the value is invalid, false otherwise.
     */
    private $myIsInvalid;

    /**
     * @var int My image type.
     */
    private $myImageType;

    /**
     * @var int My image height.
     */
    private $myImageHeight;

    /**
     * @var int My image width.
     */
    private $myImageWidth;

    /**
     * @var string My image mime type.
     */
    private $myImageMimeType;

    /**
     * @var string My image default file extension.
     */
    private $myImageDefaultFileExtension;

    /**
     * @var array My image types.
     */
    private static $myImageTypes = [
        'image/jpeg' => [ImageType::JPEG, 'jpg'],
        'image/png'  => [ImageType::PNG, 'png'],
    ];
}
