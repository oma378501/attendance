<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'studentNum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <!-- Calendar widget works. Stores in DB but need to view form editor rather than result grid to see -->
    <!-- http://www.yiiframework.com/forum/index.php/topic/61010-solved-class-form-control-with-juidatepicker-using-activeform/ -->
    <?= $form->field($model, 'dob')->widget(DatePicker::className(),
    ['clientOptions' => ['defaultDate' => '1997-01-01'],
        'dateFormat' => 'dd-MM-yyyy' ,
        'options'=>['style'=>'width:250px;', 
        'class'=>'form-control']]) ?>
    
    <!-- ?= $form->field($model, 'dob')->textInput() ? -->
    
    <!-- http://www.yiiframework.com/doc-2.0/ext-jui-index.html -->
    <!-- ?= $form->field($model,'dob')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => '1997-01-01']]) ? -->
    
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
