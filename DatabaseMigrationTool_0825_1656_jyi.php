<?php
// 代码生成时间: 2025-08-25 16:56:23
// Ensure the Yii autoloader is included
require_once('path/to/yii/framework/yii.php');

// Import Yii and console components
Yii::import('application.migrations.*');

class DatabaseMigrationTool extends CConsoleCommand {

    public function getHelp() {
        // Provide help information for the command
        return <<<EOD
Usage:
  yiic migrate
  yiic migrate/to <migrations>
  yiic migrate/down <migrations>
  yiic migrate/create <name>

Description:
  This command helps manage database migrations.

Parameters:
  - to: Applies a specific migration.
  - down: Reverts a specific number of migrations.
  - create: Creates a new migration.
EOD;
    }

    public function run($args) {
        // Check if the database component is properly configured
        $db = Yii::app()->db;
        if (!$db instanceof CDbConnection) {
            echo 'Error: Database component is not configured properly.' . PHP_EOL;
            return self::EXIT_CODE_ERROR;
        }

        try {
            // Run the migration command based on the arguments provided
            $migrator = new CDbMigrationManager($db, $this);
            $migrator->run($args);
        } catch (Exception $e) {
            // Handle any exceptions that occur during the migration process
            echo 'An error occurred during migration: ' . $e->getMessage() . PHP_EOL;
            return self::EXIT_CODE_ERROR;
        }
    }
}
