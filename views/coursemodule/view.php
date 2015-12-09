<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Coursemodule */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Assign Module To Course', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coursemodule-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'Course_id',
            'Module_id',
            'course.courseName'
        ],
    ]) ?>

</div>
