<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_module".
 *
 * @property integer $id
 * @property integer $Student_id
 * @property integer $Module_id
 *
 * @property Attendance[] $attendances
 * @property Module $module
 * @property Student $student
 */
class Studentmodule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Student_id', 'Module_id'], 'required'],
            [['Student_id', 'Module_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Student_id' => 'Student ID',
            'Module_id' => 'Module ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendances()
    {
        return $this->hasMany(Attendance::className(), ['Student_Module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Module::className(), ['id' => 'Module_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'Student_id']);
    }
    
    public static function dropdown(){
        // get and cache data
        static $dropdown;
        if ($dropdown == null){
            // get all records from database and generate
            $models = static::find()->all();
            foreach ($models as $model){
                $dropdown[$model->id] = [$model->id];
            }
            return $dropdown;
        }
    }
    
    // Query testing

    
    
}
