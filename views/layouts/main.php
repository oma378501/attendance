<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                //'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    // Change colour here?? - need to find css 
                    // http://stackoverflow.com/questions/29627555/how-to-change-the-navbar-color-in-yii2
                    //'class' => 'navbar-inverse navbar-fixed-top',
                    'class' => 'my-navbar navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    // Student through to Login labels are hidden unless the user is logged in
                    ['label' => 'Student', 'url' => ['/student/index'], 'visible'=> !Yii::$app->user->isGuest ],
                    ['label' => 'Module', 'url' => ['/module/index'], 'visible'=> !Yii::$app->user->isGuest ],
                    ['label' => 'Course', 'url' => ['/course/index'], 'visible'=> !Yii::$app->user->isGuest ],
                    ['label' => 'Assign Module To Course', 'url' => ['/coursemodule/index'], 'visible'=> !Yii::$app->user->isGuest ],
                    ['label' => 'Assign Student To Module', 'url' => ['/studentmodule/index'], 'visible'=> !Yii::$app->user->isGuest ],
                    ['label' => 'Attendance', 'url' => ['/attendance/index'], 'visible'=> !Yii::$app->user->isGuest ],
                    ['label' => 'User', 'url' => ['/user/index'], 'visible'=> !Yii::$app->user->isGuest ],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; NorthWest University <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
