<?php
/**
 * This file is a part of the image-file-field package.
 *
 * Read more at https://github.com/themichaelhall/image-file-field
 */
declare(strict_types=1);

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
     */
    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->reset();
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

        switch ($this->imageType) {
            case ImageType::JPEG:
                return imagecreatefromjpeg($filePath) ?: null;
            case ImageType::PNG:
                return imagecreatefrompng($filePath) ?: null;
            case ImageType::GIF:
                return imagecreatefromgif($filePath) ?: null;
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
    public function getImageDefaultFileExtension(): string
    {
        return $this->imageDefaultFileExtension;
    }

    /**
     * Returns the image height.
     *
     * @since 1.0.0
     *
     * @return int The image height.
     */
    public function getImageHeight(): int
    {
        return $this->imageHeight;
    }

    /**
     * Returns the image mime type.
     *
     * @since 1.0.0
     *
     * @return string The image mime type.
     */
    public function getImageMimeType(): string
    {
        return $this->imageMimeType;
    }

    /**
     * Returns the image type as one of the constants defined in the ImageType class.
     *
     * @since 1.0.0
     *
     * @return int The image type.
     */
    public function getImageType(): int
    {
        return $this->imageType;
    }

    /**
     * Returns the image width.
     *
     * @since 1.0.0
     *
     * @return int The image width.
     */
    public function getImageWidth(): int
    {
        return $this->imageWidth;
    }

    /**
     * Return true if the image file is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the image file is invalid, false otherwise.
     */
    public function isInvalid(): bool
    {
        return $this->isInvalid;
    }

    /**
     * Called when uploaded file is set from form.
     *
     * @since 1.0.0
     *
     * @param UploadedFileInterface|null $uploadedFile The file from form.
     */
    protected function onSetUploadedFile(?UploadedFileInterface $uploadedFile = null): void
    {
        parent::onSetUploadedFile($uploadedFile);

        $this->reset();

        if ($this->hasError()) {
            return;
        }

        if ($this->isEmpty()) {
            return;
        }

        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = strtolower(finfo_file($fileInfo, $uploadedFile->getPath()->__toString()));

        if (!isset(self::$imageTypes[$mimeType])) {
            $this->isInvalid = true;
            $this->setError('Invalid image file');

            return;
        }

        $imageType = self::$imageTypes[$mimeType];

        $this->imageMimeType = $mimeType;
        $this->imageType = $imageType[0];
        $this->imageDefaultFileExtension = $imageType[1];

        $imageSize = getimagesize($uploadedFile->getPath()->__toString());
        $this->imageWidth = $imageSize[0];
        $this->imageHeight = $imageSize[1];
    }

    /**
     * Resets the properties.
     */
    private function reset()
    {
        $this->isInvalid = false;
        $this->imageType = ImageType::NONE;
        $this->imageHeight = 0;
        $this->imageWidth = 0;
        $this->imageMimeType = '';
        $this->imageDefaultFileExtension = '';
    }

    /**
     * @var bool True if the value is invalid, false otherwise.
     */
    private $isInvalid;

    /**
     * @var int My image type.
     */
    private $imageType;

    /**
     * @var int My image height.
     */
    private $imageHeight;

    /**
     * @var int My image width.
     */
    private $imageWidth;

    /**
     * @var string My image mime type.
     */
    private $imageMimeType;

    /**
     * @var string My image default file extension.
     */
    private $imageDefaultFileExtension;

    /**
     * @var array My image types.
     */
    private static $imageTypes = [
        'image/jpeg' => [ImageType::JPEG, 'jpg'],
        'image/png'  => [ImageType::PNG, 'png'],
        'image/gif'  => [ImageType::GIF, 'gif'],
    ];
}
