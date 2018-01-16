<?php
/**
 * This file is a part of the image-file-field package.
 *
 * Read more at https://github.com/themichaelhall/image-file-field
 */

namespace MichaelHall\ImageFileField;

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
     * Return true if the image file is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the image file is invalid, false otherwise.
     */
    public function isInvalid()
    {
        return false;
    }
}
