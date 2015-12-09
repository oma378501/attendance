<?php

namespace app\controllers;

use Yii;
use app\models\Studentmodule;
use app\models\StudentModuleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * StudentModuleController implements the CRUD actions for StudentModule model.
 */
class StudentModuleController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all StudentModule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentModuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StudentModule model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StudentModule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentModule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StudentModule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StudentModule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentModule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StudentModule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentModule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // For dropdown of students - doesn't populate list when called from module drop down!!
    public function actionStudents($id)
    {        
        $students = \app\models\Studentmodule::find()->where(['Module_id' => $id])->all();
        
        // Returns drop down list
        foreach($students as $student){
            echo "<option value='".$student->id."'>".$student->student->studentNum."</option>";
        }
    }
    
    /* Testing to return a student list based on module_id passed in from selection of drop down
    select StudentName From student Innderjoin student.studentID = module.studentID Where module.moduleID = @value
    select student from students where studentid in (select studentid from studentmodule where moduleid = @moduleid)
    select module from modules where moduleid in (select moduleid from studentmodule where studentid = @studentid)
    
    https://github.com/yiisoft/yii2/blob/master/docs/guide/db-active-record.md
     */
    
    
    /*public function actionStudentlist(){ 
        // http://stackoverflow.com/questions/23062775/how-to-look-at-post-values-coming-to-the-controller-yii
        var_dump($_POST);
        //https://stackoverflow.com/questions/22532618/get-value-of-drop-down-in-controller
        $selected = $_POST[Studentmodule]['Module_id'];

        $students = \app\models\Studentmodule::find()->where(['Module_id' => $selected])->orderBy('id')->all();
        
        // How to return this list as a grid view??
        return $students;

    }*/
    
    public static function actionStudentlist($id){ 

        // "Response content must not be an array."
        /*$students = \app\models\Studentmodule::find()->where(['Module_id' => $id])->orderBy('id')->all();
        return $students;
         */
        
        $query = Studentmodule::find()->where(['Module_id' => $id]);
        
        // Studentmodule::find()->where(['Module_id' => $id])->orderBy('id')->asArray()->all(),
        
        $StudentDataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        
        // $students = $StudentDataProvider->getModels();
        
        echo GridView::widget([
            'id' => 'studentsGrid_' + uniqid(),
            'dataProvider' => $StudentDataProvider,
            'columns' => [
                'student.firstName',
                'student.studentNum',                
                [
                    'class' => 'yii\grid\CheckboxColumn', 
                    'checkboxOptions'=> [
                        // Pass in student_module_id and date
                        'onclick' => '$.post(\'index.php?r=attendance/createattendance&id=\'+ $(this).val() '
                        . '+ \'&date="\' + $(\'#attendance-date\').val() + \'"\');'
                        ]
                ],
//                [
//                    'content' => createButtonForGrid
//                ]
            ],
        ]);
        
        //var_dump($students);
        
//        // "Response content must be a string or an object implementing __toString()"
//        $DataProvider = new ActiveDataProvider([
//            'query' => Studentmodule::find()->where(['Module_id' => $id])->orderBy('id')->asArray()->all(),
//        ]);
//        
//        // When use this and return $Model instead of $DataProvider
//        // http://stackoverflow.com/questions/27746984/criteria-active-data-provider-in-yii-2
//        $Model= $DataProvider->getModels();
//        
//        return $Model;

    }
    
    public function actionStudentlistb($id){ 

        Student::StudentList($id);

    }
    
    private function createButtonForGrid()
    {
        echo "<input type='button' value='CLICK ME'>";
    }
}
