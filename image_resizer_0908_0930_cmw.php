<?php
// 代码生成时间: 2025-09-08 09:30:37
class ImageResizer {

    /**
     * @var string The directory path where images are stored
     */
    private $sourceDirectory;

    /**
     * @var string The directory path where resized images will be stored
     */
    private $destinationDirectory;

    /**
     * @var int The target width for the resized images
     */
    private $targetWidth;

    /**
     * @var int The target height for the resized images
     */
    private $targetHeight;

    /**
     * Constructor for ImageResizer class
     *
     * @param string $sourceDirectory The directory path of the source images
     * @param string $destinationDirectory The directory path of the destination folder
     * @param int $targetWidth The target width
     * @param int $targetHeight The target height
     */
    public function __construct($sourceDirectory, $destinationDirectory, $targetWidth, $targetHeight) {
        $this->sourceDirectory = $sourceDirectory;
        $this->destinationDirectory = $destinationDirectory;
        $this->targetWidth = $targetWidth;
        $this->targetHeight = $targetHeight;
    }

    /**
     * Resize all images in the specified directory
     *
     * @return bool True on success, False on failure
     */
    public function resizeImages() {
        if (!is_dir($this->sourceDirectory) || !is_dir($this->destinationDirectory)) {
            // Log error or throw exception
            return false;
        }

        $images = glob($this->sourceDirectory . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        foreach ($images as $image) {
            if (!$this->resizeImage($image)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Resize a single image
     *
     * @param string $imagePath The path to the image to be resized
     * @return bool True on success, False on failure
     */
    private function resizeImage($imagePath) {
        $info = getimagesize($imagePath);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($imagePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($imagePath);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($imagePath);
                break;
            default:
                // Log error or throw exception
                return false;
        }

        $width = imagesx($image);
        $height = imagesy($image);

        $newImage = imagecreatetruecolor($this->targetWidth, $this->targetHeight);
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $this->targetWidth, $this->targetHeight, $width, $height);

        $destinationPath = str_replace($this->sourceDirectory, $this->destinationDirectory, $imagePath);

        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($newImage, $destinationPath);
                break;
            case 'image/png':
                imagepng($newImage, $destinationPath);
                break;
            case 'image/gif':
                imagegif($newImage, $destinationPath);
                break;
            default:
                // Log error or throw exception
                return false;
        }

        imagedestroy($image);
        imagedestroy($newImage);

        return true;
    }
}

// Usage example
try {
    $resizer = new ImageResizer('path/to/source/images', 'path/to/destination/images', 800, 600);
    if ($resizer->resizeImages()) {
        echo 'Images resized successfully';
    } else {
        echo 'Error resizing images';
    }
} catch (Exception $e) {
    // Handle exception
    echo 'Exception: ' . $e->getMessage();
}
