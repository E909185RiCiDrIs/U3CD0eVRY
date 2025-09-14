<?php
// 代码生成时间: 2025-09-14 17:57:28
// 主题切换控制器
class ThemeSwitcherController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // 使用访问控制过滤器
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  // 允许所有用户访问
                'actions' => array('switch'),
                'users' => array('*'),
            ),
        ); // 允许游客和登录用户
    }

    // switchAction 处理主题切换请求
    public function actionSwitch()
    {
        // 获取当前用户ID
        $userId = Yii::app()->user->id;
        // 获取主题名称
        $themeName = isset($_POST['theme']) ? $_POST['theme'] : null;

        // 检查主题名称是否有效
        if (empty($themeName)) {
            // 如果主题名称为空，返回错误信息
            echo json_encode(array(
                'error' => 'Theme name is required.'
            ));
            Yii::app()->end();
        }

        // 允许的主题列表
        $allowedThemes = array('light', 'dark', 'colorful');
        if (!in_array($themeName, $allowedThemes)) {
            // 如果主题不在允许的列表中，返回错误信息
            echo json_encode(array(
                'error' => 'Invalid theme name.'
            ));
            Yii::app()->end();
        }

        // 保存主题名称到用户的偏好设置中
        $userModel = User::model()->findByPk($userId);
        if ($userModel) {
            $userModel->theme = $themeName;
            $userModel->save();

            // 返回成功信息
            echo json_encode(array(
                'success' => 'Theme switched successfully.',
                'newTheme' => $themeName
            ));
        } else {
            // 如果用户模型未找到，返回错误信息
            echo json_encode(array(
                'error' => 'User not found.'
            ));
        }
    }
}
