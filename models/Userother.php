<?php

namespace app\models;


/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $Course_id
 *
 * @property Course $course
 */
class Userother extends \yii\db\ActiveRecord implements IdentityInterface

{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Course_id'], 'required'],
            [['Course_id'], 'integer'],
            [['username', 'password'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'Course_id' => 'Course ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'Course_id']);
    }
    

    
}
