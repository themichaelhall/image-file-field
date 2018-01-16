<?php
/**
 * This file is a part of the image-file-field package.
 *
 * Read more at https://github.com/themichaelhall/image-file-field
 */

namespace MichaelHall\ImageFileField\Interfaces;

use BlueMvc\Forms\Interfaces\FileFieldInterface;

/**
 * Interface for ImageFileField class.
 *
 * @since 1.0.0
 */
interface ImageFileFieldInterface extends FileFieldInterface
{
    /**
     * Return true if the image file is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the image file is invalid, false otherwise.
     */
    public function isInvalid();
}
