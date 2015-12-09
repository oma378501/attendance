<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StudentModule */

$this->title = 'Assign Student To Module';
$this->params['breadcrumbs'][] = ['label' => 'Assign Student To Module', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-module-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
