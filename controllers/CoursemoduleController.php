<?php

namespace app\controllers;

use Yii;
use app\models\Coursemodule;
use app\models\CourseModuleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseModuleController implements the CRUD actions for Coursemodule model.
 */
class CoursemoduleController extends Controller
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
     * Lists all Coursemodule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseModuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Coursemodule model.
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
     * Creates a new Coursemodule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Coursemodule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Coursemodule model.
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
     * Deletes an existing Coursemodule model.
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
     * Finds the Coursemodule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Coursemodule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Coursemodule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionList($id)
      {
         $posts = Coursemodule::find()
                 //should be course_id?
         ->where(['Module_id' => $id])
         ->orderBy('id DESC')
         ->all();

         if($posts){
         foreach($posts as $post){

         echo "<option value='".$post->id."'>".$post->module_id."</option>";
         }
         }
         else{
         echo "<option>-</option>";
         }

    }
    
    public function actionLists($id)
    {
        $countPosts = Coursemodule::find()
                ->where(['id' => $id])
                ->count();
 
        $posts = Coursemodule::find()
                ->where(['id' => $id])
                ->orderBy('id DESC')
                ->all();
 
        if($countPosts>0){
            foreach($posts as $post){
                echo "<option value='".$post->id."'>".$post->module_id."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
 
    }
    
    // Aidens
    public function actionModules($id)
    {   
        $modules = \app\models\Coursemodule::find()->where(['Course_id' => $id])->all();
        
        foreach($modules as $module){
            echo "<option value='".$module->id."'>".$module->module->moduleName."</option>";
        }
        
        //print_r($_POST);exit();
    }

    public function actionModulesList($id)
    {
        $modules = \app\models\Coursemodule::find()->where(['Course_id' => $id])->all();
        
        foreach($modules as $module){
            echo "<option value='".$module->id."'>".$module->module->moduleName."</option>";
        }
    }
    
}
