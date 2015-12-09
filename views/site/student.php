<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form ActiveForm */
?>
<div class="student">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'studentNum') ?>
        <?= $form->field($model, 'firstName') ?>
        <?= $form->field($model, 'surname') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- student -->
