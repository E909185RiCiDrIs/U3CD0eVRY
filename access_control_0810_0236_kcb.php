<?php
// 代码生成时间: 2025-08-10 02:36:19
// Importing the Yii framework components
use Yii;
use yiiase\ActionFilter;
use yii\web\UnauthorizedHttpException;

class AccessControl extends ActionFilter
{
    /**
     * @var array List of actions that do not require authentication.
     */
    public $except = [];

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (in_array($action->id, $this->except)) {
            // If the action is in the exception list, allow access.
            return true;
        }

        // Check if the user is authenticated.
        if (!Yii::$app->user->isGuest) {
            // User is authenticated, check their role.
            $role = Yii::$app->user->identity->role;
            // Define the roles and their permissions.
            $permissions = [
                'admin' => ['create', 'update', 'delete', 'view'],
                'moderator' => ['update', 'view'],
                'user' => ['view'],
            ];
            
            // Check if the user's role has the required permission for the action.
            if (isset($permissions[$role]) && in_array($action->id, $permissions[$role])) {
                return true;
            }
        }

        // If the user is not authenticated or does not have the required permission, throw an exception.
        throw new UnauthorizedHttpException('You are not allowed to perform this action.');
    }
}
