<?php
// 代码生成时间: 2025-08-13 00:58:30
class UncompressFileTool {

    /**
     * Uncompress a file
     *
     * @param string $file_path The path to the file to uncompress
     * @param string $destination The destination directory where to extract files
     * @return bool Returns true on success, false on failure
     */
    public function uncompress($file_path, $destination) {
        if (!file_exists($file_path)) {
            // File does not exist
            Yii::error('File does not exist: ' . $file_path, __METHOD__);
            return false;
        }

        if (!is_writable($destination)) {
            // Destination is not writable
            Yii::error('Destination is not writable: ' . $destination, __METHOD__);
            return false;
        }

        $file_info = pathinfo($file_path);
        $extension = isset($file_info['extension']) ? $file_info['extension'] : '';

        switch (strtolower($extension)) {
            case 'zip':
                if (!$this->uncompressZip($file_path, $destination)) {
                    Yii::error('Failed to uncompress ZIP file: ' . $file_path, __METHOD__);
                    return false;
                }
                break;
            case 'tar':
                if (!$this->uncompressTar($file_path, $destination)) {
                    Yii::error('Failed to uncompress TAR file: ' . $file_path, __METHOD__);
                    return false;
                }
                break;
            case 'gz':
                if (!$this->uncompressGz($file_path, $destination)) {
                    Yii::error('Failed to uncompress GZ file: ' . $file_path, __METHOD__);
                    return false;
                }
                break;
            default:
                Yii::error('Unsupported file type: ' . $extension, __METHOD__);
                return false;
        }

        return true;
    }

    /**
     * Uncompress a ZIP file
     *
     * @param string $file_path The path to the ZIP file
     * @param string $destination The destination directory
     * @return bool Returns true on success, false on failure
     */
    private function uncompressZip($file_path, $destination) {
        if (!class_exists('ZipArchive')) {
            Yii::error('ZipArchive class is not available', __METHOD__);
            return false;
        }

        $zip = new ZipArchive();
        if ($zip->open($file_path) === true) {
            $zip->extractTo($destination);
            $zip->close();
            return true;
        }

        return false;
    }

    /**
     * Uncompress a TAR file
     *
     * @param string $file_path The path to the TAR file
     * @param string $destination The destination directory
     * @return bool Returns true on success, false on failure
     */
    private function uncompressTar($file_path, $destination) {
        if (!function_exists('tar_extract')) {
            Yii::error('tar_extract function is not available', __METHOD__);
            return false;
        }

        return tar_extract($file_path, $destination);
    }

    /**
     * Uncompress a GZ file
     *
     * @param string $file_path The path to the GZ file
     * @param string $destination The destination directory
     * @return bool Returns true on success, false on failure
     */
    private function uncompressGz($file_path, $destination) {
        $target_file = $destination . '/' . basename($file_path, '.gz');

        if (!file_exists($target_file) || is_writable($target_file)) {
            $file = gzopen($file_path, 'r');
            $target = fopen($target_file, 'w');

            while (!gzeof($file)) {
                fwrite($target, gzread($file, 1024 * 512));
            }

            gzclose($file);
            fclose($target);
            return true;
        }

        return false;
    }
}

// Usage example
$uncompress_tool = new UncompressFileTool();
$file_path = 'path/to/your/file.zip';
$destination = 'path/to/destination/directory';
$result = $uncompress_tool->uncompress($file_path, $destination);

if ($result) {
    echo 'File uncompression successful';
} else {
    echo 'File uncompression failed';
}
