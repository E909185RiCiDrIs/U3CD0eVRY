<?php
// 代码生成时间: 2025-08-20 05:28:47
class PasswordCrypter {

    /**
     * Encrypts a password using Yii's security component.
     *
     * @param string $password The password to be encrypted.
     * @return string Encrypted password or error message if encryption fails.
     */
    public function encryptPassword($password) {
        try {
            if (empty($password)) {
                throw new InvalidArgumentException('Password cannot be empty.');
            }

            // Use Yii's security component to encrypt the password
            $encryptedPassword = Yii::$app->security->generatePasswordHash($password);
            return $encryptedPassword;
        } catch (InvalidArgumentException $e) {
            // Handle exception and return error message
            return 'Error: ' . $e->getMessage();
        } catch (Exception $e) {
            // General exception handling
            return 'Error: Encryption failed, please try again.';
        }
    }

    /**
     * Decrypts a password using Yii's security component.
     *
     * @param string $encryptedPassword The encrypted password to be decrypted.
     * @param string $originalPassword The original password for verification.
     * @return bool True if decryption is successful and matches the original password, false otherwise.
     */
    public function decryptPassword($encryptedPassword, $originalPassword) {
        try {
            if (empty($encryptedPassword) || empty($originalPassword)) {
                throw new InvalidArgumentException('Encrypted password and original password cannot be empty.');
            }

            // Use Yii's security component to verify the password
            $isValid = Yii::$app->security->validatePassword($originalPassword, $encryptedPassword);
            return $isValid;
        } catch (InvalidArgumentException $e) {
            // Handle exception and return false
            return false;
        } catch (Exception $e) {
            // General exception handling
            return false;
        }
    }
}

// Example usage:
// $crypter = new PasswordCrypter();
// $encrypted = $crypter->encryptPassword('myPassword123');
// echo $encrypted . "
";
// $isValid = $crypter->decryptPassword($encrypted, 'myPassword123');
// echo $isValid ? 'Password is valid.' : 'Password is invalid.';