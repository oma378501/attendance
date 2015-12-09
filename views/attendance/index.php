<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AttendanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Attendance', ['create'], ['class' => 'btn btn-success']) ?>
    </p
    
    <p>
        <?= Html::a('Compare Attendance', ['compare'], ['class' => 'btn btn-success']) ?>
    </p>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //http://www.bsourcecode.com/yiiframework2/gridview-in-yiiframework-2-0/
        // Don't show widget if no data
        'showOnEmpty' =>false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'present',
            'notes:ntext',
            'Student_Module_id',
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
