<?php
// 代码生成时间: 2025-08-31 19:07:52
// batch_file_renamer.php
// 批量文件重命名工具

use yii\helpers\FileHelper;
use yiiase\Exception;

class BatchFileRenamer {

    private $sourceDirectory;
    private $targetDirectory;
    private $prefix;
    private $suffix;
    private $fileExtension;
    private $counter = 1;

    // 构造函数
    public function __construct($sourceDirectory, $targetDirectory, $prefix = '', $suffix = '', $fileExtension = '') {
        $this->sourceDirectory = $sourceDirectory;
        $this->targetDirectory = $targetDirectory;
        $this->prefix = $prefix;
        $this->suffix = $suffix;
        $this->fileExtension = $fileExtension;
    }

    // 执行文件重命名操作
    public function renameFiles() {
        try {
            if (!is_readable($this->sourceDirectory)) {
                throw new Exception("Source directory is not readable.");
            }

            if (!is_writable($this->targetDirectory)) {
                throw new Exception("Target directory is not writable.");
            }

            $files = FileHelper::findFiles($this->sourceDirectory);

            foreach ($files as $file) {
                $newFilename = $this->generateNewFilename($file);
                $newFilePath = $this->targetDirectory . DIRECTORY_SEPARATOR . $newFilename;

                if (!rename($file, $newFilePath)) {
                    throw new Exception("Failed to rename file: {$file} to {$newFilePath}.");
                }
            }

            echo "All files have been renamed successfully.\
";

        } catch (Exception $e) {
            echo "Error: {$e->getMessage()}\
";
        }
    }

    // 生成新的文件名
    private function generateNewFilename($filePath) {
        $filename = basename($filePath, '.' . pathinfo($filePath, PATHINFO_EXTENSION));
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        return $this->prefix . $this->counter . $this->suffix . '.' . $this->fileExtension ?: $extension;
    }

}

// 示例用法
$sourceDir = '/path/to/source';
$targetDir = '/path/to/target';
$prefix = 'new_';
$suffix = '';
$extension = 'txt';

$renamer = new BatchFileRenamer($sourceDir, $targetDir, $prefix, $suffix, $extension);
$renamer->renameFiles();
