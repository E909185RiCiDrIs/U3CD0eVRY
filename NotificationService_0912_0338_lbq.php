<?php
// 代码生成时间: 2025-09-12 03:38:10
class NotificationService
{
    // Database connection instance
    private $db;

    // Constructor to initialize the database connection
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Send a notification to a user.
     *
     * @param int $userId The ID of the user to send the notification to.
     * @param string $message The message to send in the notification.
     * @return bool Returns true on success, false on failure.
     */
    public function sendNotification($userId, $message)
    {
        try {
            // Prepare the SQL statement to insert the notification into the database
            $sql = "INSERT INTO notifications (user_id, message) VALUES (:userId, :message)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':message', $message);

            // Execute the query and return the result
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle any exceptions that occur during the execution
            // Log the error message for debugging purposes
            \Yii::error(\$e->getMessage(), __METHOD__);
            return false;
        }
    }

    /**
     * Retrieve all notifications for a user.
     *
     * @param int $userId The ID of the user to retrieve notifications for.
     * @return array An array of notifications for the user.
     */
    public function getUserNotifications($userId)
    {
        try {
            // Prepare the SQL statement to select notifications for the user
            $sql = "SELECT * FROM notifications WHERE user_id = :userId";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            // Fetch all the notifications as an array
            $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $notifications;
        } catch (PDOException $e) {
            // Handle any exceptions that occur during the execution
            // Log the error message for debugging purposes
            \Yii::error(\$e->getMessage(), __METHOD__);
            return [];
        }
    }
}
