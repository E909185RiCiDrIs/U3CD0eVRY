<?php
// 代码生成时间: 2025-10-07 03:55:29
class DuplicateFileDetector {

    /**
     * @var string The directory to scan for duplicates.
     */
    private $directory;

    /**
     * @var array An array to store the unique files' hashes.
     */
    private $uniqueFiles = [];

    /**
     * Constructor
     *
     * @param string $directory The directory to scan.
     */
    public function __construct($directory) {
        $this->directory = $directory;
    }

    /**
     * Scan the directory for duplicate files.
     *
     * @return array An array of duplicate files.
     */
    public function scanForDuplicates() {
        $duplicates = [];
        if (!is_dir($this->directory)) {
            throw new InvalidArgumentException('The provided directory does not exist.');
        }

        $iterator = new RecursiveDirectoryIterator($this->directory);
        $files = new RecursiveIteratorIterator($iterator);

        foreach ($files as $file) {
            if ($file->isFile()) {
                $hash = md5_file($file->getPathname());
                if (isset($this->uniqueFiles[$hash])) {
                    foreach ($this->uniqueFiles[$hash] as $duplicateFile) {
                        if ($duplicateFile !== $file->getPathname()) {
                            $duplicates[] = $file->getPathname();
                            break;
                        }
                    }
                    $this->uniqueFiles[$hash][] = $file->getPathname();
                } else {
                    $this->uniqueFiles[$hash] = [$file->getPathname()];
                }
            }
        }

        return $duplicates;
    }
}

// Example usage:
try {
//     $detector = new DuplicateFileDetector('/path/to/scan');
//     $duplicates = $detector->scanForDuplicates();
//     if (!empty($duplicates)) {
//         echo 'Duplicate files found:' . PHP_EOL;
//         foreach ($duplicates as $duplicate) {
//             echo $duplicate . PHP_EOL;
//         }
//     } else {
//         echo 'No duplicate files found.';
//     }
} catch (Exception $e) {
//     echo 'Error: ' . $e->getMessage();
// }
