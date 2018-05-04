# Image File Field

[![Build Status](https://travis-ci.org/themichaelhall/image-file-field.svg?branch=master)](https://travis-ci.org/themichaelhall/image-file-field)
[![codecov.io](https://codecov.io/gh/themichaelhall/image-file-field/coverage.svg?branch=master)](https://codecov.io/gh/themichaelhall/image-file-field?branch=master)
[![Maintainability](https://api.codeclimate.com/v1/badges/34a1b9f412f9301f794c/maintainability)](https://codeclimate.com/github/themichaelhall/image-file-field/maintainability)
[![StyleCI](https://styleci.io/repos/117742796/shield?style=flat)](https://styleci.io/repos/117742796)
[![License](https://poser.pugx.org/michaelhall/image-file-field/license)](https://packagist.org/packages/michaelhall/image-file-field)
[![Latest Stable Version](https://poser.pugx.org/michaelhall/image-file-field/v/stable)](https://packagist.org/packages/michaelhall/image-file-field)
[![Total Downloads](https://poser.pugx.org/michaelhall/image-file-field/downloads)](https://packagist.org/packages/michaelhall/image-file-field)

Image file upload field for the  [BlueMvc PHP framework](https://github.com/themichaelhall/bluemvc).

## Requirements

- PHP >= 7.1

## Install with Composer

``` bash
$ composer require michaelhall/image-file-field
```

## Basic usage

ImageFileField extends the [FileField](https://github.com/themichaelhall/bluemvc-forms/blob/master/src/FileField.php) class to provide additional functionality for uploaded image handling. 

The following image types are supported: 
- JPEG
- PNG
- GIF

### Create an image file field

```php
// Construct as an ordinary form field.
$imageFileField = new ImageFileField('image');
```

### Use in validation / after processing
```php
// Returns true if uploaded file is not a valid image, false otherwise.
$imageFileField->isInvalid();

// Returns the image type, e.g. ImageType::JPEG.
$imageFileField->getImageType();

// Returns the image mime type, e.g. 'image/jpeg'.
$imageFileField->getImageMimeType();

// Returns the default file extension for the image type, e.g. 'jpg'.
$imageFileField->getImageDefaultFileExtension();

// Returns the image width, e.g. 1000.
$imageFileField->getImageWidth();

// Returns the image height, e.g. 500.
$imageFileField->getImageHeight();

// Returns an image resource, created from the relevant imagecreatefrom* function.
$imageFileField->getImage();
```

## License

MIT
