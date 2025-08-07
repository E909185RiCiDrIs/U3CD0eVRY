<?php
// 代码生成时间: 2025-08-08 02:22:55
class DataBackupRestore {

    /**
     * 数据备份方法
     *
     * @param string $sourcePath 源数据路径
     * @param string $backupPath 备份数据路径
     * @return bool 备份结果
     */
    public function backupData($sourcePath, $backupPath) {
        try {
            // 检查源路径是否存在
            if (!is_dir($sourcePath)) {
                throw new Exception("源路径不存在: {$sourcePath}");
            }

            // 创建备份目录
            if (!is_dir($backupPath)) {
                mkdir($backupPath, 0777, true);
            }

            // 获取源目录下所有文件
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($sourcePath),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                // 跳过目录
                if (!$file->isFile()) continue;

                // 计算目标路径
                $targetPath = $backupPath . DIRECTORY_SEPARATOR . $file->getRelativePathname();

                // 创建目标目录
                $dir = dirname($targetPath);
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }

                // 复制文件
                copy($file, $targetPath);
            }

            return true;
        } catch (Exception $e) {
            // 错误处理
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * 数据恢复方法
     *
     * @param string $backupPath 备份数据路径
     * @param string $restorePath 恢复数据路径
     * @return bool 恢复结果
     */
    public function restoreData($backupPath, $restorePath) {
        try {
            // 检查备份路径是否存在
            if (!is_dir($backupPath)) {
                throw new Exception("备份路径不存在: {$backupPath}");
            }

            // 创建恢复目录
            if (!is_dir($restorePath)) {
                mkdir($restorePath, 0777, true);
            }

            // 获取备份目录下所有文件
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($backupPath),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                // 跳过目录
                if (!$file->isFile()) continue;

                // 计算目标路径
                $targetPath = $restorePath . DIRECTORY_SEPARATOR . $file->getRelativePathname();

                // 创建目标目录
                $dir = dirname($targetPath);
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }

                // 复制文件
                copy($file, $targetPath);
            }

            return true;
        } catch (Exception $e) {
            // 错误处理
            error_log($e->getMessage());
            return false;
        }
    }
}
