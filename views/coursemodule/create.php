<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Coursemodule */

$this->title = 'Assign Module To Course';
$this->params['breadcrumbs'][] = ['label' => 'Assign Module To Course', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coursemodule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
