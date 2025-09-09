<?php
// 代码生成时间: 2025-09-09 19:42:35
class UnzipTool {

    /**
     * Unzips a file to a specified directory.
     *
     * @param string $archivePath Path to the archive file.
     * @param string $destinationPath Path to the destination directory.
     * @return bool True on success, false on failure.
     */
    public function unzip($archivePath, $destinationPath) {
        try {
            // Check if the archive file exists
            if (!file_exists($archivePath)) {
                \Yii::error("Archive file does not exist: {$archivePath}", __METHOD__);
                return false;
            }

            // Create the destination directory if it does not exist
            if (!is_dir($destinationPath)) {
                if (!mkdir($destinationPath, 0777, true)) {
                    \Yii::error("Failed to create destination directory: {$destinationPath}", __METHOD__);
                    return false;
                }
            }

            // Use the PharData class to extract the archive
            if (class_exists('PharData')) {
                $phar = new PharData($archivePath);
                $phar->extractTo($destinationPath, null, true);
            } else {
                // Fallback to ZipArchive if PharData is not available
                if (class_exists('ZipArchive')) {
                    $zip = new ZipArchive;
                    if ($zip->open($archivePath) === true) {
                        $zip->extractTo($destinationPath);
                        $zip->close();
                    } else {
                        \Yii::error("Failed to open the archive file: {$archivePath}", __METHOD__);
                        return false;
                    }
                } else {
                    \Yii::error("Neither PharData nor ZipArchive class is available.", __METHOD__);
                    return false;
                }
            }

            return true;
        } catch (Exception $e) {
            \Yii::error("Unzip failed: " . $e->getMessage(), __METHOD__);
            return false;
        }
    }
}

// Example usage:
// $unzipTool = new UnzipTool();
// $result = $unzipTool->unzip('/path/to/archive.zip', '/path/to/destination');
// if ($result) {
//     echo 'Unzip successful.';
// } else {
//     echo 'Unzip failed.';
// }
