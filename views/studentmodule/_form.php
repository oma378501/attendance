<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Student;
use app\models\Module;

/* @var $this yii\web\View */
/* @var $model app\models\StudentModule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-module-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <!-- THIS WORKS - NO VALIDATION FOR DUPLICATES YET -->
    <?= $form->field($model, 'Student_id')->dropDownList(
            ArrayHelper::map(Student::find()->all(), 'id', 'studentNum'),
            ['prompt'=>'Select Student']
    ) ?>
    
    <?= $form->field($model, 'Module_id')->dropDownList(
            // 3 parameters - model to get the data from, 
            ArrayHelper::map(Module::find()->all(), 'id', 'moduleName'),
            ['prompt'=>'Select Module']
    ) ?>
    
    <!-- END -->

    <!-- ?= $form->field($model, 'Student_id')->textInput() -- ?>

    <! -- ?= $form->field($model, 'Module_id')->textInput() ? -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
