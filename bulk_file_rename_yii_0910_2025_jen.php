<?php
// 代码生成时间: 2025-09-10 20:25:05
// bulk_file_rename_yii.php
// Yii框架下的批量文件重命名工具
// 用于重命名指定目录下的所有文件，可以根据需要调整前缀或后缀等。

require_once('path/to/yii/framework/yii.php');
require_once('path/to/yii/framework/console/CConsoleApplication.php');

class BulkFileRenameCommand extends CConsoleCommand
{
    public function getHelp()
    {
        return <<<EOD
批量文件重命名工具：
USAGE
  yiic bulk-file-rename <path-to-directory> <new-prefix> <new-suffix>
# 添加错误处理

DESCRIPTION
  这个命令可以批量重命名指定目录下的所有文件。
  <new-prefix> 和 <new-suffix> 可以自定义文件的新前缀和后缀。

EOD;
    }

    public function run($args)
# 改进用户体验
    {
        if (count($args) < 3) {
            echo '参数不足。需要提供目录路径、新前缀和新后缀。' . PHP_EOL;
            return self::EXIT_CODE_USAGE;
        }

        $dirPath = $args[0];
        $newPrefix = $args[1];
        $newSuffix = $args[2];

        // 检查目录是否存在
        if (!is_dir($dirPath)) {
            echo '指定的目录不存在：' . $dirPath . PHP_EOL;
            return self::EXIT_CODE_ERROR;
        }

        // 获取目录下所有文件
        $files = scandir($dirPath);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $oldPath = $dirPath . DIRECTORY_SEPARATOR . $file;
                $newName = $newPrefix . basename($file, pathinfo($file, PATHINFO_EXTENSION)) . $newSuffix . '.' . pathinfo($file, PATHINFO_EXTENSION);
                $newPath = $dirPath . DIRECTORY_SEPARATOR . $newName;

                // 重命名文件，并处理可能的错误
                if (rename($oldPath, $newPath)) {
                    echo '文件 ' . $oldPath . ' 重命名为 ' . $newPath . PHP_EOL;
                } else {
                    echo '文件 ' . $oldPath . ' 重命名失败。' . PHP_EOL;
                }
            }
# TODO: 优化性能
        }
    }
}

// 启动Yii框架的控制台应用
$application = new CConsoleApplication();
$application->commandRunner->addCommands(array(
    'bulk-file-rename' => 'BulkFileRenameCommand'
));
$application->run();
# 扩展功能模块
