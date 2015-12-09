<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course_module".
 *
 * @property integer $id
 * @property integer $Course_id
 * @property integer $Module_id
 *
 * @property Course $course
 * @property Module $module
 */
class Coursemodule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Course_id', 'Module_id'], 'required'],
            [['Course_id', 'Module_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Course_id' => 'Course ID',
            'Module_id' => 'Module ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'Course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Module::className(), ['id' => 'Module_id']);
    }
    
    // TESTING
    
    public static function dropdown(){
        // get and cache data
        static $dropdown;
        if ($dropdown == null){
            // get all records from database and generate
            $models = static::find()->all();
            foreach ($models as $model){
                $dropdown[$model->id] = [$model->Module_id];
            }
            return $dropdown;
        }
    }
}
