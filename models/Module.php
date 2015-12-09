<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "module".
 *
 * @property integer $id
 * @property string $moduleName
 * @property string $moduleNum
 *
 * @property CourseModule[] $courseModules
 * @property StudentModule[] $studentModules
 */
class Module extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moduleName', 'moduleNum'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'moduleName' => 'Module Name',
            'moduleNum' => 'Module Num',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseModules()
    {
        return $this->hasMany(CourseModule::className(), ['Module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentModules()
    {
        return $this->hasMany(StudentModule::className(), ['Module_id' => 'id']);
    }
    
    
    /**
     * TESTING
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'course' => array(self::BELONGS_TO, 'Course', 'id'),
            // Testing
            //'course' => array(self::BELONGS_TO, 'Course', 'course'),
        );
    }
    
    // TESTING
    
    public static function dropdown(){
        // get and cache data
        static $dropdown;
        if ($dropdown == null){
            // get all records from database and generate
            $models = static::find()->all();
            foreach ($models as $model){
                $dropdown[$model->id] = [$model->moduleName];
            }
            return $dropdown;
        }
    }
}
