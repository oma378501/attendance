<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentModule */

$this->title = 'Update Student Module: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-module-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
