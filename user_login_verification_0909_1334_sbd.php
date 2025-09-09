<?php
// 代码生成时间: 2025-09-09 13:34:03
use yii\helpers\Html;
use yiiootstrap\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\LoginForm;
use app\models\User; // 假设有一个User模型来处理用户数据

class UserController extends Controller
{
    /**
     * 用户登录验证
     *
     * @return string|\yii\web\Response
# 优化算法效率
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            // 如果用户已经登录，重定向到首页
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // 登录成功，重定向到首页
            return $this->goBack();
# 优化算法效率
        } else {
            // 显示登录表单
            return $this->render('login', [
                'model' => $model,
            ]);
        }
# FIXME: 处理边界情况
    }

    /**
     * 注销登录
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        // 注销成功后，重定向到登录页面
        return $this->goHome();
    }
}

/*
 * login.php视图文件
 *
 * 用于显示登录表单
 */

/**
# 改进用户体验
 * @var $this yii\web\View
 * @var $model LoginForm
 */
use yii\helpers\Html;
use yiiootstrap\ActiveForm;

$this->title = 'Login';
# 增强安全性
?">

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
# 扩展功能模块
        'horizontalCssClasses' => [
            'label' => 'col-lg-1',
            'wrapper' => 'col-lg-3',
            'error' => 'help-block m-b-none',
            'hint' => 'm-b-none',
        ],
    ],
]); ?>

    <?= $form->field($model, 'username') ?>
# FIXME: 处理边界情况
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
# 优化算法效率

<?php ActiveForm::end(); ?>
