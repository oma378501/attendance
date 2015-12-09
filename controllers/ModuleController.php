<?php

namespace app\controllers;

use Yii;
use app\models\Module;
use app\models\ModuleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModuleController implements the CRUD actions for Module model.
 */
class ModuleController extends Controller
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
     * Lists all Module models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Module model.
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
     * Creates a new Module model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Module();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Module model.
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
     * Deletes an existing Module model.
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
     * Finds the Module model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Module the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Module::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // TESTING FOR DYNAMIC DROP DOWN
    public function actionList($id){
        $countModules = \app\models\CourseModuleSearch::find()
                ->where(['Module_id' => $id])
                ->count();
        
        $modules = Module::find() 
                ->where(['id' => $id])
                ->all();
        
        if ($countModules > 0){
            foreach($modules as $module ){
                echo "<option value='".$module->id."'>".$module->moduleName."</option>";
            }
        }
        else{
            echo "<option> - </option>";
        }
    }
    
    //http://www.dukaweb.net/2015/04/dependent-dropdown-list-from-scratch-in-yii2.html
    public function actionLists($id) {
     $countModules = Module::find()
          ->where(['id' => $id])
          ->count();
     $modules = Module::find()
          ->where(['id' => $id])
          ->orderBy('id DESC')
          ->all();
     if($countModules>0) {
          foreach($module as $module){
               echo "<option value='".$modules->id."'>".$modules->id."</option>";
          }
     }
     else{
          echo "<option>-</option>";
     }
}

    //https://www.youtube.com/watch?v=ZepxKw8VA7w

}
