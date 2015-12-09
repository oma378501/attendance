<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Attendance Management System';
?>
<div class="site-index">

    <div class="jumbotron">
        <!-- Logo was working but now no! 
        <p><img src="attendance\web\assets\logo.png" /></p>-->
        <p><img src="..\assets\LogoNorthwestUniverity.png" /></p>
        <!--?= Html::img('\attendance\web\assets\northwest.png');?-->
        <h1>Attendance Management System</h1>

        <!-- <p class="lead">You have successfully created your Yii-powered application.</p> 
        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>  -->
        <!-- <a class="btn btn-lg btn-success" href="index.php?r=site/login">Login</a></p> -->
        <!-- site/login means controller/action -->
       
        
        <!-- Only display login button if the user is currently logged in 
        http://stackoverflow.com/questions/33254870/how-to-disable-a-button-in-yii2
        http://stackoverflow.com/questions/27401047/yii2-button-with-link -->
         <p>
             <?php
             if (Yii::$app->user->isGuest){
                echo Html::a('Login', ['/site/login'], ['class'=>'btn btn-primary']);
             }
             ?>
      
    </div>
    

    <!--
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Placeholder for text.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Placeholder for text.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Placeholder for text.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
    -->
            </div>
        </div>

    </div>
</div>
