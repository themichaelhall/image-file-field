<?php
/**
 * This file is a part of the image-file-field package.
 *
 * Read more at https://github.com/themichaelhall/image-file-field
 */
declare(strict_types=1);

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
     * Returns the image resource, for the image file or null if no valid image is uploaded.
     *
     * @since 1.0.0
     *
     * @return resource|null The image resource for the image file or null.
     */
    public function getImage();

    /**
     * Returns the image default file extension.
     *
     * @since 1.0.0
     *
     * @return string The image default file extension.
     */
    public function getImageDefaultFileExtension(): string;

    /**
     * Returns the image height.
     *
     * @since 1.0.0
     *
     * @return int The image height.
     */
    public function getImageHeight(): int;

    /**
     * Returns the image mime type.
     *
     * @since 1.0.0
     *
     * @return string The image mime type.
     */
    public function getImageMimeType(): string;

    /**
     * Returns the image type as one of the constants defined in the ImageType class.
     *
     * @since 1.0.0
     *
     * @return int The image type.
     */
    public function getImageType(): int;

    /**
     * Returns the image width.
     *
     * @since 1.0.0
     *
     * @return int The image width.
     */
    public function getImageWidth(): int;

    /**
     * Return true if the image file is invalid, false otherwise.
     *
     * @since 1.0.0
     *
     * @return bool True if the image file is invalid, false otherwise.
     */
    public function isInvalid(): bool;
}
