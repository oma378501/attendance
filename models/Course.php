<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $courseName
 * @property string $courseNum
 *
 * @property CourseModule[] $courseModules
 * @property User[] $users
 */
class Course extends \yii\db\ActiveRecord
//class Course extends CActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['courseName', 'courseNum'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'courseName' => 'Course Name',
            'courseNum' => 'Course Num',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseModules()
    {
        return $this->hasMany(CourseModule::className(), ['Course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['Course_id' => 'id']);
    }
    
    /**
     * TESTING
     */
    public function relations()
    {
        return array(
            'modules' => array(self::HAS_MANY, 'Module', 'id'),
            //'modules' => array(self::HAS_MANY, 'Module', 'course'),
        );
    }
    
    // Gives empy list
    public static function dropdown(){
        // get and cache data
        static $dropdown;
        if ($dropdown == null){
            // get all records from database and generate
            $models = static::find()->all();
            foreach ($models as $model){
                $dropdown[$model->id] = [$model->courseName];
            }
            return $dropdown;
        }
    }
    
    public static function courseDropDown() 
    {
        $courses = Course::find()->all();
        //$courses = Course::courseDropDown();
        //$courseList = ArrayHelper::map($courses, 'id', 'courseName');
        
        foreach((array)$courses as $course){
            echo "<option value='".$course->id."'>".$course->courseName."</option>";
        }
    }
    
    //Gives error  unknown Course::course or problem with foreach
     /* public static function dropdownItems(){
        $students = \app\models\Course::find()->all();
        
        // Returns drop down list
        foreach($students as $student){
            echo "<option value='".$student->id."'>".$student->courseName."</option>";
        }
    }
      * */
     
}
