<?php
// 代码生成时间: 2025-09-03 01:45:04
// Image Resize Batch Processor using PHP and YII framework
// This script resizes images in a directory to a specified size

class ImageResizeBatchProcessor {

    private $sourceDirectory;
    private $destinationDirectory;
    private $newWidth;
    private $newHeight;
    private $imageQuality;

    // Constructor method to initialize the object properties
    public function __construct($sourceDir, $destDir, $width, $height, $quality) {
        $this->sourceDirectory = $sourceDir;
        $this->destinationDirectory = $destDir;
        $this->newWidth = $width;
        $this->newHeight = $height;
        $this->imageQuality = $quality;
    }

    // Method to process the image resizing batch
    public function process() {
        if (!file_exists($this->sourceDirectory) || !is_dir($this->sourceDirectory)) {
            throw new Exception('Source directory does not exist.');
        }

        if (!file_exists($this->destinationDirectory) && !mkdir($this->destinationDirectory, 0777, true)) {
            throw new Exception('Failed to create destination directory.');
        }

        $files = scandir($this->sourceDirectory);
        foreach ($files as $file) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                $this->resizeImage($this->sourceDirectory . '/' . $file,
                                  $this->destinationDirectory . '/' . $file);
            }
        }
    }

    // Method to resize a single image
    private function resizeImage($sourcePath, $destinationPath) {
        try {
            $image = new Imagick($sourcePath);
            $image->resizeImage($this->newWidth, $this->newHeight, Imagick::FILTER_LANCZOS, 1);
            $image->setImageCompression(Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality($this->imageQuality);
            $image->writeImage($destinationPath);
            $image->clear();
            $image->destroy();
        } catch (ImagickException $e) {
            throw new Exception('Failed to resize image: ' . $e->getMessage());
        }
    }
}

// Example usage:
try {
    $sourceDir = '/path/to/source/directory';
    $destDir = '/path/to/destination/directory';
    $width = 800;
    $height = 600;
    $quality = 85;

    $processor = new ImageResizeBatchProcessor($sourceDir, $destDir, $width, $height, $quality);
    $processor->process();

    echo "Images have been resized successfully.
";
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage() . "
";
}
