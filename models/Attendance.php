<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property integer $id
 * @property integer $present
 * @property string $notes
 * @property integer $Student_Module_id
 * @property string $date
 *
 * @property StudentModule $studentModule
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['present', 'Student_Module_id'], 'integer'],
            [['notes'], 'string'],
            [['Student_Module_id', 'date'], 'required'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'present' => 'Present',
            'notes' => 'Notes',
            'Student_Module_id' => 'Student  Module ID',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentModule()
    {
        return $this->hasOne(StudentModule::className(), ['id' => 'Student_Module_id']);
    }
    
    
    
    
}
