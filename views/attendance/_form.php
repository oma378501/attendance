<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Course;
use app\models\Module;
use app\models\Studentmodule;
use app\models\Coursemodule;
use app\controllers\AttendanceController;
use yii\db\Query;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
//use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Attendance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendance-form">

    <!-- Change method to get as defaults to post (test for getting post module_id) ??
    ['method' => 'get', 'action' => ['studentmodule/students'],]-->
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'date')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'getdate()'],'dateFormat' => 'dd-MM-yyyy' ,'options'=>['style'=>'width:250px;', 'class'=>'form-control']]) ?>
   
    <!-- "Given you have selected a course_id, you can retrieve a list of modules via the course_module table. 
         Then given you select a module_id from this list then you can retrieve a list of students taking that module 
         via the student_module table"  -->
    
    <!-- http://www.dukaweb.net/2015/04/dependent-dropdown-list-from-scratch-in-yii2.html 
    <!-- https://www.youtube.com/watch?v=ZepxKw8VA7w -->
    <!-- How to change field to Course Name? As id is pulling from attendance model -->   
    <!-- DEPENDENT DROP DOWN WORKING BUT WHEN YOU SELECT FROM MODULE, ALL DROP DOWNS UPDATES TO THE MODULE NAME!! -->
    
    
    <?= $form->field($model, 'id')->dropDownList( 
            // Gives id of 0 when select a course so module drop down doesn't populate
            // Wrapped in ArrayHelper but give empty list
            //Course::dropdown(),
            ArrayHelper::map(Course::find()->all(), 'id', 'courseName'),
            ['prompt'=>'Select Course',
                // Inspect dropdown element to get correct select#id
                // Create myCustomId to stop all drop downs updating when a course is selected
            'name' => 'id',
             'onchange'=>'
                $.post( "index.php?r=coursemodule/modules&id=' . '"+$(this).val(), function( data ) {
                  $( "select#myCustomId" ).html( data );
                });'
            ]); 

          

     // This prints attendance/create - was hoping to print array
     // Tried $_POST but nothing prints
        /*$ids = $_GET;
        foreach($ids as $id){
            echo $id;
        }
         */
    ?>
    
    <!-- Creating custom id form input field in inputOptions
    Pass in class to make drop down same width.
    https://github.com/yiisoft/yii2/issues/7627 -->
    <!--?= $form->field($model, 'id', ['inputOptions' => ['id' => 'myCustomId', 'class' => 'form-control']])
            ->dropDownList([],
            ['prompt'=>'Select Module',
             'onchange'=>'
                $.post( "index.php?r=studentmodule/studentlist&id=' . '"+$(this).val(), function( data ) {
                  $( "select#customid" ).html( data );
                });'
            ]); ?-->
    
    <!-- FROM HERE NEED TO PASS SELECTED MODULE ID TO A CONTROLLER THAT RETURNS A LIST OP STUDENTS -->
    
    <!--?= $form->field($model, 'id', ['inputOptions' => ['id' => 'myCustomId', 'class' => 'form-control']])
                    ->dropDownList([],
            ['prompt'=>'Select Module',
                // This displays pop up of of selected module id
                /*'onchange'=>'
                var sel = $(this).val();
                alert(sel);'
                 */
                // This passes selected module id into controller - see controller for error
                'onchange'=>'
                $.post( "index.php?r=studentmodule/studentlist&id=' . '"+$(this).val());' 
                ]);
    ?>-->
    
    <?= $form->field($model, 'id', ['inputOptions' => ['id' => 'myCustomId', 'class' => 'form-control']])
                    ->dropDownList([],
            ['prompt'=>'Select Module',
                // This displays pop up of of selected module id
                /*'onchange'=>'
                var sel = $(this).val();
                alert(sel);'
                 */
                // This passes selected module id into controller - see controller for error
                'onchange'=>'
                    $.post( "index.php?r=studentmodule/studentlist&id=' . '"+$(this).val(), function( data ) {
                      $( "#studentsDataGrid" ).html( data );
                    });' 
                ]);
    ?>
    
    <div id="studentsDataGrid">
    </div>
       
    <!-- Some kind of AJAX call like this to pass "selected" to a query in controller ???
    $('select[name="Module_Id"]').on('change', function(){
    var selected = $('select[name="Module_Id"]').find(':selected').val();
    $.ajax({
        url: test.php+ '?' + selected,
        type: 'GET'
        success:function(data) {
           handleData(data);
        }
    });        
    }); --?  

    <!-- http://stackoverflow.com/questions/27746984/criteria-active-data-provider-in-yii-2 -->
    <!-- http://www.yiiframework.com/wiki/772/pjax-on-activeform-and-gridview-yii2/ -->
    
 
    <!-- Student list doesn't load anything-->
    <!-- ?= $form->field($model, 'id', ['inputOptions' => ['id' => 'customid', 'class' => 'form-control']])
                    ->dropDownList([],
            ['prompt'=>'Select Student']); ?> -->    
    
    
    <!-- Empty array [] initially in drop down -->
    <!--?= $form->field($model, 'id')->dropDownList([],
            ['prompt'=>'Select Module']);
    ? -->
    <!--?= $form->field($model, 'id')->dropDownList([],
            ['prompt'=>'Select Module',
                // Inspect dropdown to get correct select#
             'onchange'=>'
                $.post( "index.php?r=studentmodule/students&id=' . '"+$(this).val(), function( data ) {
                  $( "select#attendance-student_module_id" ).html( data );
                });'
            ]); ?> -->
    
    <!-- ?= $form->field($model, 'Student_Module_id')->textInput() ? -->
    <!--?= $form->field($model, 'Student_Module_id')->dropDownList(    
            ArrayHelper::map(Studentmodule::find()->all(), 'id', 'Student_id'),
            ['id'=>'Student_id']
           ); ? -->
     <!--?= $form->field($model, 'id')->dropDownList([],
            ['prompt'=>'Select Student']); ?>   -->
    
    <!--?= $form->field($model, 'Student_Module_id')->textInput() ?--> 
    
    <!-- ?= $form->field($model, 'present')->checkbox() ?> -->
    
    <!--<input type="checkbox" name="option" value="estado" checked /> --> 
    <!-- Calling unknown method: yii\widgets\ActiveForm::checkBox() 
    http://www.yiiframework.com/forum/index.php/topic/17001-activeform-checkbox-checked/ -->
    <!-- ?php echo $form->checkBox($model,'present',  array('checked'=>'checked')); ?> -->

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
    
    <!-- http://www.yiiframework.com/forum/index.php/topic/61010-solved-class-form-control-with-juidatepicker-using-activeform/ -->
    <!--?= $form->field($model, 'date')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => 'getdate()'],'dateFormat' => 'dd-MM-yyyy' ,'options'=>['style'=>'width:250px;', 'class'=>'form-control']]) ?> -->
     
    <!-- http://stackoverflow.com/questions/27757648/yii2-ajax-post-to-controller-from-dropdownlist-of-view-and-some-action-upon-rec -->
    <!-- test -->
    <!-- ?= $form->field($model, 'id')->dropDownList(
            ArrayHelper::map(Course::find()->all(), 'id', 'courseName'),
            ['prompt'=>'Please Select',
                        'ajax'=> array(
                            'empty'=>'Please Select',
                            'type'=>'POST',
                            'url' => CController::createUrl('module'),
                            'data'=> array('jdok'=>'js:this.value'),
                            'update'=>'#module',
                            ))           
           ]; ?>

    echo CHtml::DropDownList('Module','', array()); -->
    
    <!-- http://stackoverflow.com/questions/24199595/how-to-make-ajax-call-in-yii2 -->
    <!-- ?= Html::a('Your Link name','controller/action', [
        'title' => Yii::t('yii', 'Close'),
        'onclick'=>"$('#close').dialog('open');//for jui dialog in my page
         $.ajax({
        type     :'POST',
        cache    : false,
        url  : 'controller/action',
        success  : function(response) {
        $('#close').html(response);
    }
    });return false;",
                ]); ?> -->
     
    
    <!--?= $form->field($model, 'id')->dropDownList($items) ? --> 
    
    <!--?= $form->field($model, 'plan_type', ['options' => ['class' => ' input select']])->dropdownList
            ( $this->params['items'],['prompt'=>'Select Plan','class' => 'selectpicker', 'data-live-search' => 'true','label'=>false]);? -->
    
    <!-- Select Module -->
    <!-- ?= $form->field($model, 'id')->dropDownList(
            ArrayHelper::map(Module::find()->all(), 'id', 'moduleName'),
            ['id'=>'moduleName']
    ) ?> -->

    <!-- ?= $form->field($model, 'date')->textInput() ? -->
    
    <!-- http://www.yiiframework.com/doc-2.0/ext-jui-index.html 
    http://www.yiiframework.com/doc-2.0/ext-jui-index.html#installation
    Need to install datepicker. Error - Class 'yii\jui\DatePicker' not found
    Updated composer via cmd, got the following error
    "composer require --prefer-dist yiisoft/yii2-jui throws error - ./composer is not writable"
    Executed same command from c/wamp/www/attendance but fatal error call to undefined method
    Tried to add "yiisoft/yii2-jui": "~2.0.0" to require section of composer.json as well 
    Also tried "kartik-v/yii2-widget-datepicker": "@dev" in json-->
    <!-- ?= $form->field($model,'date')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => '2015-01-01']]) ? -->

    
    <!-- Will need something like this for gridview of data? - 
    Active data provider needs to go in controller as function?
    http://www.yiiframework.com/doc-2.0/guide-output-data-providers.html 
    http://stackoverflow.com/questions/27746984/criteria-active-data-provider-in-yii-2
    http://www.yiiframework.com/wiki/772/pjax-on-activeform-and-gridview-yii2/ -->
    
    
    <!-- ERROR - Object of class yii\data\ActiveDataProvider could not be converted to string -->
    <!--?=$query = StudentModule::find()->where(['Module_id' => 1]);
    $provider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'defaultOrder' => [
            'created_at' => SORT_DESC,
            'title' => SORT_ASC, 
        ]
    ],
    ]); 

    // returns an array of Post objects
    $posts = $provider->getModels(); ?-->
    
    <!-- ERROR - Object of class yii\data\ActiveDataProvider could not be converted to string -->
    <!--?= $dataProvider = new ActiveDataProvider([
    'query' => app\models\Studentmodule::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
    ]); ?-->
    
     <!--?= GridView::widget([
     'dataProvider' => $dataProvider,bgc
     'filterModel' => $searchModel,
     'columns' => [
         ['class' => 'yii\grid\SerialColumn'],[
	'attribute'=>'parentid',
	'label'=>'Parent Name',
	'format'=>'text',//raw, html
	'content'=>function($data){
		return $data->getStudentModules();
		}
        ],
         ['class' => 'yii\grid\ActionColumn'],
     ],
 ]); ?-->
    
    
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    


    <?php ActiveForm::end(); ?>

</div>
