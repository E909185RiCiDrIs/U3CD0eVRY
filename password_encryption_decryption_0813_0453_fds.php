<?php
// 代码生成时间: 2025-08-13 04:53:59
class PasswordUtility {

    /**
     * Encrypts a password using a secret key.
     *
     * @param string $password The password to be encrypted.
     * @param string $secretKey The secret key used for encryption.
     * @return string The encrypted password.
     * @throws Exception If encryption fails.
     */
    public static function encryptPassword($password, $secretKey) {
        try {
            // Use OpenSSL for encryption
            $ivlen = openssl_cipher_iv_length('aes-256-cbc');
            $iv = openssl_random_pseudo_bytes($ivlen);
            $cipherText = openssl_encrypt($password, 'aes-256-cbc', $secretKey, $options=0, $iv);
            // Prepend the IV for use during decryption
            $encrypted = base64_encode($iv . $cipherText);
            return $encrypted;
        } catch (Exception $e) {
            // Handle encryption failure
            throw new Exception('Encryption failed: ' . $e->getMessage());
        }
    }

    /**
     * Decrypts a password using a secret key.
     *
     * @param string $encrypted The encrypted password.
     * @param string $secretKey The secret key used for decryption.
     * @return string The decrypted password.
     * @throws Exception If decryption fails.
     */
    public static function decryptPassword($encrypted, $secretKey) {
        try {
            // Decode the IV and cipher text from the encrypted string
            $ivlen = openssl_cipher_iv_length('aes-256-cbc');
            $data = base64_decode($encrypted);
            $iv = substr($data, 0, $ivlen);
            $cipherText = substr($data, $ivlen);
            // Decrypt the password
            $password = openssl_decrypt($cipherText, 'aes-256-cbc', $secretKey, $options=0, $iv);
            return $password;
        } catch (Exception $e) {
            // Handle decryption failure
            throw new Exception('Decryption failed: ' . $e->getMessage());
        }
    }

    // Example usage
    public static function runExample() {
        $secretKey = 'your_secret_key';
        $password = 'my_password';
        $encrypted = self::encryptPassword($password, $secretKey);
        $decrypted = self::decryptPassword($encrypted, $secretKey);

        echo "Encrypted: " . $encrypted . "
";
        echo "Decrypted: " . $decrypted . "
";
    }

    public static function main() {
        try {
            self::runExample();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// Run the main function to demonstrate the utility
PasswordUtility::main();