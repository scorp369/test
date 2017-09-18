<?php

/**
 * @var $this    \yii\web\View
 * @var $content string
 */

use app\rbac\Permissions;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\components\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        'brandLabel' => 'Новостной сайт',
        'brandUrl'   => Yii::$app->homeUrl,
        'options'    => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items'   => [
            ['label' => 'Home', 'url' => ['/']],
            Yii::$app->user->can(Permissions::NEWS_MANAGE) ? (
            ['label' => 'crud новостей', 'url' => ['/news/list']]
            ) : (''),Yii::$app->user->can(Permissions::USER_MANAGE) ? (
            ['label' => 'crud пользователей', 'url' => ['/user/list']]
            ) : (''),
            Yii::$app->user->isGuest ? (
            ['label' => 'Register', 'url' => ['/register']]
            ) : (''),
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . app()->user->identity->login . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Новостной сайт <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
