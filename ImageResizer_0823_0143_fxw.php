<?php
// 代码生成时间: 2025-08-23 01:43:47
class ImageResizer extends CComponent
{
    private $sourcePath; // Path to the directory containing the source images
    private $targetPath; // Path to the directory where resized images will be saved
    private $maxWidth;   // Maximum width of the resized image
    private $maxHeight; // Maximum height of the resized image
    private $imageTypes; // Array of allowed image types
    private $overwrite;  // Flag to determine whether to overwrite existing files

    /**
     * Constructor for ImageResizer class.
     *
     * @param string $sourcePath Path to the directory containing the source images.
     * @param string $targetPath Path to the directory where resized images will be saved.
     * @param int $maxWidth Maximum width of the resized image.
     * @param int $maxHeight Maximum height of the resized image.
     * @param array $imageTypes Array of allowed image types.
     * @param bool $overwrite Flag to determine whether to overwrite existing files.
     */
    public function __construct($sourcePath, $targetPath, $maxWidth, $maxHeight, $imageTypes = array('jpg', 'jpeg', 'png', 'gif'), $overwrite = false)
    {
        $this->sourcePath = $sourcePath;
        $this->targetPath = $targetPath;
        $this->maxWidth = $maxWidth;
        $this->maxHeight = $maxHeight;
        $this->imageTypes = $imageTypes;
        $this->overwrite = $overwrite;
    }

    /**
     * Resizes all images in the source directory to the specified dimensions.
     *
     * @return bool True on success, false on failure.
     */
    public function resizeImages()
    {
        if (!is_dir($this->sourcePath)) {
            throw new CException('Source directory does not exist.');
        }

        if (!is_dir($this->targetPath)) {
            if (!mkdir($this->targetPath, 0777, true)) {
                throw new CException('Failed to create target directory.');
            }
        }

        $images = $this->getImages();
        foreach ($images as $image) {
            $this->resizeImage($image);
        }

        return true;
    }

    /**
     * Gets an array of images in the source directory.
     *
     * @return array Array of image files.
     */
    private function getImages()
    {
        $images = array();
        $files = scandir($this->sourcePath);
        foreach ($files as $file) {
            if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $this->imageTypes)) {
                $images[] = $this->sourcePath . DIRECTORY_SEPARATOR . $file;
            }
        }

        return $images;
    }

    /**
     * Resizes a single image to the specified dimensions.
     *
     * @param string $imagePath Path to the image file.
     * @return bool True on success, false on failure.
     */
    private function resizeImage($imagePath)
    {
        $targetPath = $this->targetPath . DIRECTORY_SEPARATOR . basename($imagePath);
        if (file_exists($targetPath) && !$this->overwrite) {
            return false;
        }

        list($width, $height) = getimagesize($imagePath);
        $ratio = $width / $height;
        if ($width > $this->maxWidth) {
            $width = $this->maxWidth;
            $height = $width / $ratio;
        }
        if ($height > $this->maxHeight) {
            $height = $this->maxHeight;
            $width = $height * $ratio;
        }

        $image = $this->createImage($imagePath);
        if (!$image) {
            return false;
        }

        $resizedImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $width, $height, $width, $height);

        switch (strtolower(pathinfo($imagePath, PATHINFO_EXTENSION))) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($resizedImage, $targetPath);
                break;
            case 'png':
                imagepng($resizedImage, $targetPath);
                break;
            case 'gif':
                imagegif($resizedImage, $targetPath);
                break;
            default:
                return false;
        }

        imagedestroy($image);
        imagedestroy($resizedImage);

        return true;
    }

    /**
     * Creates an image resource from a file.
     *
     * @param string $imagePath Path to the image file.
     * @return resource|bool Image resource on success, false on failure.
     */
    private function createImage($imagePath)
    {
        switch (strtolower(pathinfo($imagePath, PATHINFO_EXTENSION))) {
            case 'jpg':
            case 'jpeg':
                return imagecreatefromjpeg($imagePath);
            case 'png':
                return imagecreatefrompng($imagePath);
            case 'gif':
                return imagecreatefromgif($imagePath);
            default:
                return false;
        }
    }
}
