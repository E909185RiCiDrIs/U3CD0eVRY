<?php
// 代码生成时间: 2025-08-01 14:56:48
// Define the Yii class autoloader
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require_once __DIR__ . '/vendor/autoload.php';

// Use Yii namespaces
use yii\helpers\FileHelper;
use yii\helpers\Console;

class FileBackupSyncTool {

    /**
     * @var string Source directory path
     */
    private $sourceDir;

    /**
     * @var string Destination directory path
     */
    private $destDir;

    /**
     * Constructor
     *
     * @param string $sourceDir Source directory path
     * @param string $destDir Destination directory path
     */
    public function __construct($sourceDir, $destDir) {
        $this->sourceDir = rtrim($sourceDir, '/') . '/';
        $this->destDir = rtrim($destDir, '/') . '/';
    }

    /**
     * Backup files from source to destination
     *
     * @return bool Returns true on success, false on failure
     */
    public function backupFiles() {
        try {
            // Check if source and destination directories exist
            if (!is_dir($this->sourceDir) || !is_dir($this->destDir)) {
                Console::output('Source or destination directory does not exist.');
                return false;
            }

            // Copy files from source to destination
            $files = FileHelper::findFiles($this->sourceDir);
            foreach ($files as $file) {
                if (!FileHelper::copy($file, $this->destDir . basename($file))) {
                    Console::output("Failed to copy file: $file");
                    return false;
                }
            }

            Console::output('Backup completed successfully.');
            return true;
        } catch (Exception $e) {
            Console::output("Error: {$e->getMessage()}");
            return false;
        }
    }

    /**
     * Sync files between source and destination
     *
     * @return bool Returns true on success, false on failure
     */
    public function syncFiles() {
        try {
            // Check if source and destination directories exist
            if (!is_dir($this->sourceDir) || !is_dir($this->destDir)) {
                Console::output('Source or destination directory does not exist.');
                return false;
            }

            // Sync files between source and destination
            $sourceFiles = FileHelper::findFiles($this->sourceDir);
            $destFiles = FileHelper::findFiles($this->destDir);

            foreach ($sourceFiles as $file) {
                $destFile = $this->destDir . basename($file);
                if (!in_array($destFile, $destFiles)) {
                    if (!FileHelper::copy($file, $this->destDir . basename($file))) {
                        Console::output("Failed to copy file: $file");
                        return false;
                    }
                } elseif (filemtime($file) > filemtime($destFile)) {
                    if (!FileHelper::copy($file, $this->destDir . basename($file))) {
                        Console::output("Failed to update file: $file");
                        return false;
                    }
                }
            }

            // Remove files in destination that are not in source
            $destFiles = array_map('basename', $destFiles);
            foreach ($destFiles as $file) {
                if (!in_array($this->sourceDir . $file, $sourceFiles)) {
                    if (!FileHelper::removeDirectory($this->destDir . $file)) {
                        Console::output("Failed to remove file: $file");
                        return false;
                    }
                }
            }

            Console::output('Sync completed successfully.');
            return true;
        } catch (Exception $e) {
            Console::output("Error: {$e->getMessage()}");
            return false;
        }
    }

}

// Usage example
$sourceDir = '/path/to/source/directory';
$destDir = '/path/to/destination/directory';
$tool = new FileBackupSyncTool($sourceDir, $destDir);

// Backup files
if ($tool->backupFiles()) {
    Console::output('Backup was successful.');
} else {
    Console::output('Backup failed.');
}

// Sync files
if ($tool->syncFiles()) {
    Console::output('Sync was successful.');
} else {
    Console::output('Sync failed.');
}
