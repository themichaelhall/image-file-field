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

        $this->myIsInvalid = false;
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

        $this->myIsInvalid = false;

        if ($this->hasError()) {
            return;
        }

        if ($this->isEmpty()) {
            return;
        }
    }

    /**
     * @var bool True if the value is invalid, false otherwise.
     */
    private $myIsInvalid;
}
