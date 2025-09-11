<?php
// 代码生成时间: 2025-09-11 19:40:42
class FolderStructureOrganizer {

    // 目标文件夹路径
    private $targetDir;

    // 源文件夹路径
    private $sourceDir;

    // 构造函数，初始化源文件夹和目标文件夹路径
    public function __construct($sourceDir, $targetDir) {
        $this->sourceDir = $sourceDir;
        $this->targetDir = $targetDir;
    }

    // 整理文件夹结构
    public function organize() {
        try {
            // 检查源文件夹是否存在
            if (!is_dir($this->sourceDir)) {
                throw new Exception("源文件夹不存在");
            }

            // 创建目标文件夹（如果不存在）
            if (!is_dir($this->targetDir)) {
                mkdir($this->targetDir, 0777, true);
            }

            // 遍历源文件夹中的所有文件和目录
            $files = scandir($this->sourceDir);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    $sourceFilePath = $this->sourceDir . '/' . $file;
                    $targetFilePath = $this->targetDir . '/' . $file;

                    // 如果是文件，则移动到目标文件夹
                    if (is_file($sourceFilePath)) {
                        if (!rename($sourceFilePath, $targetFilePath)) {
                            throw new Exception("无法移动文件 {$file}");
                        }
                    } elseif (is_dir($sourceFilePath)) {
                        // 如果是目录，则递归整理子目录
                        $this->organizeSubDirectory($sourceFilePath, $targetFilePath);
                    }
                }
            }

            echo "文件夹结构整理完成";

        } catch (Exception $e) {
            // 错误处理
            echo "发生错误：{$e->getMessage()}";
        }
    }

    // 递归整理子目录
    private function organizeSubDirectory($sourceDir, $targetDir) {
        // 创建目标子目录
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // 遍历子目录中的所有文件和目录
        $files = scandir($sourceDir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $sourceFilePath = $sourceDir . '/' . $file;
                $targetFilePath = $targetDir . '/' . $file;

                // 如果是文件，则移动到目标子目录
                if (is_file($sourceFilePath)) {
                    if (!rename($sourceFilePath, $targetFilePath)) {
                        throw new Exception("无法移动文件 {$file}");
                    }
                } elseif (is_dir($sourceFilePath)) {
                    // 如果是子目录，则递归整理
                    $this->organizeSubDirectory($sourceFilePath, $targetFilePath);
                }
            }
        }
    }
}

// 使用示例
$sourceDir = "/path/to/source/folder";
$targetDir = "/path/to/target/folder";
$organizer = new FolderStructureOrganizer($sourceDir, $targetDir);
$organizer->organize();
