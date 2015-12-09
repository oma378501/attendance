<?php

namespace app\models;

use Yii;
use app\models\Studentmodule;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $studentNum
 * @property string $firstName
 * @property string $surname
 * @property string $email
 * @property string $dob
 *
 * @property StudentModule[] $studentModules
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //Validators
            [['studentNum', 'firstName', 'surname', 'email', 'dob'], 'required'],
            [['dob'], 'safe'],
            [['studentNum'], 'string', 'max' => 10],
            [['firstName', 'surname', 'email'], 'string', 'max' => 45],
            ['email', 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'studentNum' => 'Student Num',
            'firstName' => 'First Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'dob' => 'Dob',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentModules()
    {
        return $this->hasMany(StudentModule::className(), ['Student_id' => 'id']);
    }
    
    // TESTING
        public function actionStudentlist($id){ 

        // "Response content must not be an array."
        /*$students = \app\models\Studentmodule::find()->where(['Module_id' => $id])->orderBy('id')->all();
        return $students;
         */
        
        // "Response content must be a string or an object implementing __toString()"
        $DataProvider = new ActiveDataProvider([
            'query' => Studentmodule::find()->where(['Module_id' => $id])->orderBy('id')->all(),
        ]);
        
        // When use this and return $Model instead of $DataProvider
        // http://stackoverflow.com/questions/27746984/criteria-active-data-provider-in-yii-2
        $Model= $DataProvider->getModels();
        
        return $Model;

    }
    
        
    
    
}
