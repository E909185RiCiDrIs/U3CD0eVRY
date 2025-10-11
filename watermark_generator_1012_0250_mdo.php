<?php
// 代码生成时间: 2025-10-12 02:50:35
class WatermarkGenerator {

    // 构造函数，初始化水印文本和字体大小
    public function __construct($text, $fontSize = 12) {
        $this->text = $text;
        $this->fontSize = $fontSize;
    }

    // 添加水印到图像上
    public function addWatermark($imagePath, $outputPath) {
        // 检查图像是否存在
        if (!file_exists($imagePath)) {
            throw new Exception("Image file not found: {$imagePath}");
        }

        // 读取图像
        $image = $this->loadImage($imagePath);
        if (!$image) {
            throw new Exception("Failed to load image: {$imagePath}");
        }

        // 创建水印图像
        $watermark = $this->createWatermarkImage();
        if (!$watermark) {
            throw new Exception("Failed to create watermark image");
        }

        // 将水印图像合并到原始图像上
        if (!$this->mergeImages($image, $watermark, $outputPath)) {
            throw new Exception("Failed to merge images");
        }
    }

    // 加载图像资源
    protected function loadImage($imagePath) {
        $imageInfo = getimagesize($imagePath);
        switch ($imageInfo[2]) {
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($imagePath);
            case IMAGETYPE_PNG:
                return imagecreatefrompng($imagePath);
            case IMAGETYPE_GIF:
                return imagecreatefromgif($imagePath);
            default:
                return null;
        }
    }

    // 创建水印图像
    protected function createWatermarkImage() {
        // 创建一个新图像，使用与原始图像相同的大小
        $width = 100;
        $height = 30;
        $image = imagecreatetruecolor($width, $height);

        // 设置背景颜色为透明
        $transparent = imagecolorallocatealpha($image, 0, 0, 0, 100);
        imagefill($image, 0, 0, $transparent);
        imagecolortransparent($image, $transparent);

        // 设置文本颜色
        $textColor = imagecolorallocate($image, 255, 255, 255);

        // 设置字体大小和字体
        $font = "arial.ttf";
        imagettftext($image, $this->fontSize, 0, 10, 20, $textColor, $font, $this->text);

        return $image;
    }

    // 合并图像
    protected function mergeImages($sourceImage, $watermarkImage, $outputPath) {
        // 获取原始图像和水印图像的大小
        $sourceWidth = imagesx($sourceImage);
        $sourceHeight = imagesy($sourceImage);
        $watermarkWidth = imagesx($watermarkImage);
        $watermarkHeight = imagesy($watermarkImage);

        // 创建一个新的图像资源，用于保存合并后的图像
        $mergedImage = imagecreatetruecolor($sourceWidth, $sourceHeight);
        imagecopy($mergedImage, $sourceImage, 0, 0, 0, 0, $sourceWidth, $sourceHeight);
        imagecopy($mergedImage, $watermarkImage, $sourceWidth - $watermarkWidth - 10, $sourceHeight - $watermarkHeight - 10, 0, 0, $watermarkWidth, $watermarkHeight);

        // 输出图像到文件
        switch (exif_imagetype($sourceImage)) {
            case IMAGETYPE_JPEG:
                imagejpeg($mergedImage, $outputPath);
                break;
            case IMAGETYPE_PNG:
                imagepng($mergedImage, $outputPath);
                break;
            case IMAGETYPE_GIF:
                imagegif($mergedImage, $outputPath);
                break;
            default:
                return false;
        }

        // 释放图像资源
        imagedestroy($sourceImage);
        imagedestroy($watermarkImage);
        imagedestroy($mergedImage);

        return true;
    }
}

// 示例用法
try {
    $watermarkGenerator = new WatermarkGenerator("Your Watermark Text", 20);
    $watermarkGenerator->addWatermark("path/to/input/image.jpg", "path/to/output/image.jpg");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
