<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Module */
/* @var $form ActiveForm */
?>
<div class="module">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'moduleName') ?>
        <?= $form->field($model, 'moduleNum') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- module -->
