<?php
// 代码生成时间: 2025-09-19 13:13:24
// 图片尺寸批量调整器
// ImageResizer.php
# NOTE: 重要实现细节

// 引入YII框架核心类
require_once 'path/to/yii/framework/yii.php';

class ImageResizer extends CComponent {
    private $sourceDir; // 源图片目录
    private $targetDir; // 目标图片目录
    private $width;     // 目标宽度
    private $height;   // 目标高度
# FIXME: 处理边界情况
    private $quality;  // 图片质量
    private $allowedExtensions; // 允许的图片扩展名

    public function __construct($sourceDir, $targetDir, $width, $height, $quality = 90) {
        $this->sourceDir = $sourceDir;
        $this->targetDir = $targetDir;
        $this->width = $width;
# 添加错误处理
        $this->height = $height;
        $this->quality = $quality;
        $this->allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    }

    // 批量调整图片尺寸
    public function resizeImages() {
        if (!is_dir($this->sourceDir) || !is_dir($this->targetDir)) {
            throw new CException('Source or target directory does not exist.');
        }
        
        $files = scandir($this->sourceDir);
        foreach ($files as $file) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), $this->allowedExtensions)) {
                $this->resizeImage($this->sourceDir . '/' . $file, $this->targetDir . '/' . $file);
            }
        }
    }

    // 调整单个图片尺寸
    private function resizeImage($sourcePath, $targetPath) {
        $image = new CImageFile($sourcePath);
# 优化算法效率
        if (!$image->getIsImage()) {
# 增强安全性
            throw new CException('Invalid image file: ' . $sourcePath);
        }

        $image->resize($this->width, $this->height);
        $image->save($targetPath, ['quality' => $this->quality]);
    }
}
# 改进用户体验

// 使用示例
try {
    $resizer = new ImageResizer('path/to/source', 'path/to/target', 800, 600);
    $resizer->resizeImages();
# TODO: 优化性能
    echo 'Images resized successfully.';
} catch (CException $e) {
    echo 'Error: ' . $e->getMessage();
}