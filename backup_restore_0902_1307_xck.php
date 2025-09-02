<?php
// 代码生成时间: 2025-09-02 13:07:33
class BackupRestore {

    /**
     * @var string Path to the backup directory.
     */
    private $backupDir;

    /**
     * Constructor for BackupRestore class.
     * @param string $backupDir Path to the backup directory.
     */
    public function __construct($backupDir) {
        $this->backupDir = $backupDir;
    }

    /**
     * Creates a backup of the specified database.
     * @param string $dbName Name of the database to backup.
     * @return string The path to the backup file or an error message.
     */
    public function backupDatabase($dbName) {
        try {
            $backupFile = $this->backupDir . '/' . $dbName . '_' . date('YmdHis') . '.sql';
            $command = "mysqldump -u username -ppassword $dbName > $backupFile";
            exec($command, $output, $returnVar);
            if ($returnVar === 0) {
                return $backupFile;
            } else {
                return "Error: Unable to backup database.";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /**
     * Restores a database from a backup file.
     * @param string $backupFile Path to the backup file.
     * @return bool True on success or an error message.
     */
    public function restoreDatabase($backupFile) {
        try {
            $command = "mysql -u username -ppassword database_name < $backupFile";
            exec($command, $output, $returnVar);
            if ($returnVar === 0) {
                return true;
            } else {
                return "Error: Unable to restore database from file: $backupFile";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}

// Usage example
$backupRestore = new BackupRestore('/path/to/backup/dir');
$backupPath = $backupRestore->backupDatabase('my_database');
echo $backupPath; // Output the path to the backup file or an error message.

$restoreStatus = $backupRestore->restoreDatabase('/path/to/backup/dir/my_database_20230401123456.sql');
echo $restoreStatus; // Output true on success or an error message.

?>