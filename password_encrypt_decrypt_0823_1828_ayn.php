<?php
// 代码生成时间: 2025-08-23 18:28:46
class PasswordEncryptDecrypt {

    /**
     * Encrypts a password using PHP's password_hash function.
     *
     * @param string $password The password to be encrypted.
     * @return string The encrypted password.
     */
    public function encryptPassword($password) {
        // Ensure the password is a string
        if (!is_string($password)) {
            throw new InvalidArgumentException('Password must be a string.');
        }

        // Encrypt the password
        $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the password was encrypted successfully
        if ($encryptedPassword === false) {
            throw new RuntimeException('Failed to encrypt password.');
        }

        return $encryptedPassword;
    }

    /**
     * Decrypts a password using PHP's password_verify function.
     *
     * @param string $password The original password to be verified.
     * @param string $encryptedPassword The encrypted password to be verified against.
     * @return bool Returns true if the passwords match, false otherwise.
     */
    public function decryptPassword($password, $encryptedPassword) {
        // Ensure the password and encrypted password are strings
        if (!is_string($password) || !is_string($encryptedPassword)) {
            throw new InvalidArgumentException('Both password and encrypted password must be strings.');
        }

        // Verify the password against the encrypted password
        $isMatch = password_verify($password, $encryptedPassword);

        return $isMatch;
    }
}

// Example usage:
try {
    $passwordEncryptDecrypt = new PasswordEncryptDecrypt();

    // Encrypt a password
    $originalPassword = 'my_secret_password';
    $encryptedPassword = $passwordEncryptDecrypt->encryptPassword($originalPassword);

    echo "Encrypted Password: " . $encryptedPassword . "
";

    // Decrypt a password (verify if the original password matches the encrypted one)
    $isMatch = $passwordEncryptDecrypt->decryptPassword($originalPassword, $encryptedPassword);

    if ($isMatch) {
        echo "Password matches!
";
    } else {
        echo "Password does not match.
";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "
";
}
