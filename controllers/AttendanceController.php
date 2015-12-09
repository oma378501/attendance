<?php

namespace app\controllers;

use Yii;
use app\models\Attendance;
use app\models\AttendanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Coursemodule;

/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class AttendanceController extends Controller
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
     * Lists all Attendance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AttendanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Attendance model.
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
     * Creates a new Attendance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Attendance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Attendance model.
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
     * Deletes an existing Attendance model.
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
     * Finds the Attendance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attendance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attendance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /** TESTING FROM HERE FOR DROP DOWNS **/
    public function actionTest(){
        $model = new SomeModel();
        $items=ArrayHelper::map(\app\models\Course::find()->all(),'id','courseName');
        $this->view->params['items'] = $items;
        return $this->render('view',['model'=>$model, 'items'=>$items]);
    }
    
    public function actionList_module($id){
        // Count
        $countmodule = Coursemodule::find()->where(['id'=>$id])->count();
        $module = Coursemodule::find()->where(['id'=>$id])->orderBy('id DESC')->all();
        if ($countmodule >0){
            foreach ($module as $result) {
                echo "<option value='" . $result->id . "'>" . $result->Module_id . "</option>";
            }
        }else {
            echo "<option>-</option>";
        }
    }
    
    //** TESTING QUERIES **//
    /*public static function xAxis(){
        
        static $dataArray = array();

        $qry = mysql_query("SELECT id , studentName FROM student");

        while($res = mysql_fetch_array($qry)) {
         $dataArray[$res['id']] = $res['StudentName'];
        }
        return $dataArray;
    }
     */  
    
    public function actionCreateattendance($id, $date)
    {
         echo "Student: " . $id . " | Date: " . $date;
        
    }
        
    public function actionCompare()
    {
        $model = new Attendance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            // this renders title "Compare Attendance"
            return $this->render('compare', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionPie() {
    $dataProvider = new ActiveDataProvider([
        'query' => Attendance::find()->where(['present' => '1'])->all(),
        'pagination' => false
    ]);

    return $this->render('pie', [
        'dataProvider' => $dataProvider
    ]);
}
}
