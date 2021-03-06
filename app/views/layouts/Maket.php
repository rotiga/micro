<?php
use \Micro\web\helpers\Html;
use \Micro\Micro;

/** @var string $content */
/** @var \App\components\Controller $this */

$this->registerScriptFile('/css/jquery.js');
$this->registerCssFile('/css/main.css');
?>
<?= Html::doctype('html5') ?>
<html>
<head>
    <?= Html::charset('utf-8') ?>
    <?= Html::meta('language', 'ru') ?>
    <?= Html::favicon('/favicon.png') ?>
    <?= Html::meta('viewport', 'width=device-width, initial-scale=1.0') ?>
    <?= Html::title($this->title) ?>
</head>
<body>
<div id="container">
    <div id="top">
        <span><?= Micro::getInstance()->config['company'] ?></span> <?= Micro::getInstance()->config['slogan'] ?>
    </div>
    <div id="content">
        <?php $this->widget('App\widgets\MenubarWidget', ['links' => $this->menu]); ?>
        <?= $content ?>
    </div>
    <div id="footer">
        &copy; <?= Micro::getInstance()->config['company'] ?> <?= date('Y') ?>
    </div>
</div>
</body>
</html>