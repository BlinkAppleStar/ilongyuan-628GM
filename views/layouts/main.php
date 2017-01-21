<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\MgManagerPermission;

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
        'brandLabel' => '龙渊网络游戏数据平台',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    if (Yii::$app->user->isGuest) {
        $menu = [
            ['label' => '登录', 'url' => ['/site/login']]
        ];
    } else {

        $permission = new MgManagerPermission();
        $menu[] = ['label' => '玩家', 'url' => ['/gamer/index']];
        if ($permission->checkAccess(Yii::$app->user->id, 'access_announce_module')) {
            $menu[] = ['label' => '公告', 'url' => ['/announce/view-index']];
        }
        if ($permission->checkAccess(Yii::$app->user->id, 'access_email_module')) {
            $menu[] = ['label' => '邮件', 'url' => ['/email/view-queue-list']];
        }
        $menu[] = ['label' => '订单', 'url' => ['/order/index']];
        if ($permission->checkAccess(Yii::$app->user->id, 'access_cdk_module')) {
            $menu[] = ['label' => '礼包', 'url' => ['/cdk/view-gift-list']];
        }
        $menu[] = ['label' => '封号', 'url' => ['/black-list/list']];
        $menu[] = ['label' => '反馈', 'url' => ['/feed-back/view-list']];
        if (Yii::$app->user->_identity->username == 'admin' || Yii::$app->user->_identity->username == 'heguobin') {
            $menu[] = ['label' => '权限', 'url' => ['/permission/manager-index']];
            $menu[] = ['label' => '账号', 'url' => ['/manager/list']];
        }
        $menu[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    '退出 (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menu,
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
        <p class="pull-left">&copy; 龙渊网络 <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
