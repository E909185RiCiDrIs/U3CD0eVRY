<?php
// 代码生成时间: 2025-09-15 22:38:08
class ProcessManager {

    /**
     * @var array List of processes currently being managed
     */
    private $processes = [];

    /**
     * Start a new process
     *
     * @param string $command The command to execute
     * @param string $name A unique name for the process
     * @return bool True on success, false on failure
     */
    public function startProcess($command, $name) {
        try {
            // Check if process already exists
            if (isset($this->processes[$name])) {
                throw new Exception("Process '{$name}' already exists.");
            }

            // Start the process
            $process = proc_open($command, [], $pipes);
            if (!is_resource($process)) {
                throw new Exception("Failed to start process '{$name}'.");
            }

            // Store the process in the list
            $this->processes[$name] = $process;

            return true;
        } catch (Exception $e) {
            // Handle any errors that occur during process start
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Stop a process
     *
     * @param string $name The name of the process to stop
     * @return bool True on success, false on failure
     */
    public function stopProcess($name) {
        try {
            // Check if process exists
            if (!isset($this->processes[$name])) {
                throw new Exception("Process '{$name}' not found.");
            }

            // Stop the process
            $process = $this->processes[$name];
            proc_terminate($process);
            fclose($process);
            unset($this->processes[$name]);

            return true;
        } catch (Exception $e) {
            // Handle any errors that occur during process stop
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Restart a process
     *
     * @param string $name The name of the process to restart
     * @param string $command The new command to execute
     * @return bool True on success, false on failure
     */
    public function restartProcess($name, $command) {
        try {
            // Stop the process if it exists
            if ($this->stopProcess($name)) {
                // Start the process with the new command
                return $this->startProcess($command, $name);
            }

            return false;
        } catch (Exception $e) {
            // Handle any errors that occur during process restart
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Get the status of a process
     *
     * @param string $name The name of the process to check
     * @return mixed The process status or null if not found
     */
    public function getProcessStatus($name) {
        if (isset($this->processes[$name])) {
            $process = $this->processes[$name];
            return proc_get_status($process);
        }

        return null;
    }

}
