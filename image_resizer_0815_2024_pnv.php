<?php
// 代码生成时间: 2025-08-15 20:24:30
// ImageResizer.php
// 一个简单的图片尺寸批量调整器类

class ImageResizer {
# TODO: 优化性能
    // 文件路径
    private $sourcePath;
    // 目标路径
    private $targetPath;
    // 图片尺寸
    private $newWidth;
    private $newHeight;
# NOTE: 重要实现细节

    // 构造函数，初始化路径和尺寸
    public function __construct($sourcePath, $targetPath, $newWidth, $newHeight) {
        $this->sourcePath = $sourcePath;
        $this->targetPath = $targetPath;
        $this->newWidth = $newWidth;
# 增强安全性
        $this->newHeight = $newHeight;
    }

    // 调整图片尺寸
    public function resizeImages() {
        if (!is_dir($this->sourcePath)) {
            throw new Exception('源路径不存在');
        }

        if (!is_writable($this->targetPath)) {
# 改进用户体验
            throw new Exception('目标路径不可写');
        }

        $images = $this->getImagesFromDirectory($this->sourcePath);

        foreach ($images as $image) {
            $this->resizeImage($this->sourcePath . DIRECTORY_SEPARATOR . $image, 
                            $this->targetPath . DIRECTORY_SEPARATOR . $image);
        }
    }
# 添加错误处理

    // 获取目录中的所有图片文件
    private function getImagesFromDirectory($directory) {
        $images = [];
        $files = scandir($directory);

        foreach ($files as $file) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                $images[] = $file;
            }
        }
# 添加错误处理

        return $images;
    }

    // 调整单张图片尺寸
    private function resizeImage($source, $target) {
        $image = $this->openImage($source);
        $newImage = imagecreatetruecolor($this->newWidth, $this->newHeight);
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $this->newWidth, $this->newHeight, imagesx($image), imagesy($image));

        if (pathinfo($source, PATHINFO_EXTENSION) == 'jpeg' || pathinfo($source, PATHINFO_EXTENSION) == 'jpg') {
            imagejpeg($newImage, $target, 90);
        } elseif (pathinfo($source, PATHINFO_EXTENSION) == 'png') {
            imagepng($newImage, $target);
        } elseif (pathinfo($source, PATHINFO_EXTENSION) == 'gif') {
            imagegif($newImage, $target);
        }

        imagedestroy($newImage);
        imagedestroy($image);
    }
# TODO: 优化性能

    // 打开图片文件
# 优化算法效率
    private function openImage($source) {
        switch (pathinfo($source, PATHINFO_EXTENSION)) {
            case 'jpeg':
            case 'jpg':
# 添加错误处理
                return imagecreatefromjpeg($source);
            case 'png':
# 添加错误处理
                return imagecreatefrompng($source);
            case 'gif':
                return imagecreatefromgif($source);
            default:
                throw new Exception('不支持的图片格式');
        }
    }
# 优化算法效率
}

// 使用示例
# 增强安全性
try {
# TODO: 优化性能
    $resizer = new ImageResizer('/path/to/source', '/path/to/target', 800, 600);
    $resizer->resizeImages();
    echo '图片尺寸调整完成。';
} catch (Exception $e) {
    echo '错误: ' . $e->getMessage();
}
# 优化算法效率
