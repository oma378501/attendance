<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserOther */

$this->title = 'Create User Other';
$this->params['breadcrumbs'][] = ['label' => 'User Others', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-other-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
