<?php
/**
 * This file is a part of the image-file-field package.
 *
 * Read more at https://github.com/themichaelhall/image-file-field
 */

namespace MichaelHall\ImageFileField;

/**
 * Image type constants.
 *
 * @since 1.0.0
 */
class ImageType
{
    /**
     * No image type.
     *
     * @since 1.0.0
     */
    const NONE = -1;

    /**
     * GIF image.
     *
     * @since 1.0.0
     */
    const GIF = \IMAGETYPE_GIF;

    /**
     * JPEG image.
     *
     * @since 1.0.0
     */
    const JPEG = \IMAGETYPE_JPEG;

    /**
     * PNG image.
     *
     * @since 1.0.0
     */
    const PNG = \IMAGETYPE_PNG;
}
