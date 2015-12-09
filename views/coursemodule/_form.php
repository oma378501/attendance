<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Course;
use app\models\Module;

/* @var $this yii\web\View */
/* @var $model app\models\Coursemodule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coursemodule-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- This lets you select course and module from drop down and add them to 
    courseModule table. NO validation for duplicates -->
    <?= $form->field($model, 'Course_id')->dropDownList( 
            ArrayHelper::map(Course::find()->all(), 'id', 'courseName'),
            // Below doesn't work! - "Invalid argument supplied for foreach()"
            //ArrayHelper::map(Course::courseDropDown(), 'id', 'courseName'),
            ['prompt'=>'Select Course',
            ]); ?>
    
    <?= $form->field($model, 'Module_id')->dropDownList(
            ArrayHelper::map(Module::find()->all(), 'id', 'moduleName'),
            ['prompt'=>'Select Module']); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
