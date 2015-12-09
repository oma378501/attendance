<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;



class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    private function loadModel($id)
    {
      $model = Posts::find($id);
      
      if ($model == NULL) {
            throw new HttpException(404, 'Model not found.');
        }

        return $model;
    }
    
    public function actionStudent()
    {
        $model = new Student();

        // if the post data is set, the user submitted the form
        if ($model->load(Yii::$app->request->post())) {
            // in that case, validate the data
            if ($model->validate()) {
                // save it to the database
                $model->save();	
                return;
            }
        }
        // by default, diplay the form
        return $this->render('student', [
            'model' => $model,
        ]);
    }
    
     public function actionModule()
    {
        $model = new Module();

        // if the post data is set, the user submitted the form
        if ($model->load(Yii::$app->request->post())) {
            // in that case, validate the data
            if ($model->validate()) {
                // save it to the database
                $model->save();	
                return;
            }
        }
        // by default, diplay the form
        return $this->render('module', [
            'model' => $model,
        ]);
    }


    
}
