<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CourseModuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assign Module To Course';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coursemodule-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Assign Course To Module', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'Course_id',
            //'Module_id',
            /* relation name in controller . attribute name
            http://www.yiiframework.com/forum/index.php/topic/51051-foreign-key-relations-in-yii2-activerecord/ */
            'course.courseName',
            'module.moduleName',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
