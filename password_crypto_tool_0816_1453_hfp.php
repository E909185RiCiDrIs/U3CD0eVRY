<?php
// 代码生成时间: 2025-08-16 14:53:55
use Yii;
use yiiase\Component;
use yiiase\InvalidParamException;

class PasswordCryptoTool extends Component
{
    /**
     * Encrypts a password using Yii's security component.
     *
     * @param string $password The password to encrypt.
     * @return string The encrypted password.
     * @throws InvalidParamException If the password is empty or not a string.
     */
    public function encryptPassword($password)
    {
        if (empty($password) || !is_string($password)) {
            throw new InvalidParamException('Password must be a non-empty string.');
        }

        return Yii::$app->security->encryptByKey($password, 'my-encryption-key');
    }

    /**
     * Decrypts a password using Yii's security component.
     *
     * @param string $encryptedPassword The encrypted password to decrypt.
     * @return string The decrypted password.
     * @throws InvalidParamException If the encrypted password is empty or not a string.
     */
    public function decryptPassword($encryptedPassword)
    {
        if (empty($encryptedPassword) || !is_string($encryptedPassword)) {
            throw new InvalidParamException('Encrypted password must be a non-empty string.');
        }

        return Yii::$app->security->decryptByKey($encryptedPassword, 'my-encryption-key');
    }
}
