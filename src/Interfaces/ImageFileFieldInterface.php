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
     * Returns the image height.
     *
     * @since 1.0.0
     *
     * @return int The image height.
     */
    public function getImageHeight();

    /**
     * Returns the image mime type.
     *
     * @since 1.0.0
     *
     * @return string The image mime type.
     */
    public function getImageMimeType();

    /**
     * Returns the image type as one of the constants defined in the ImageType class.
     *
     * @since 1.0.0
     *
     * @return int The image type.
     */
    public function getImageType();

    /**
     * Returns the image width.
     *
     * @since 1.0.0
     *
     * @return int The image width.
     */
    public function getImageWidth();

    /**
     * Return true if the image file is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the image file is invalid, false otherwise.
     */
    public function isInvalid();
}
