<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Coursemodule;

/**
 * CourseModuleSearch represents the model behind the search form about `app\models\Coursemodule`.
 */
class CourseModuleSearch extends Coursemodule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Course_id', 'Module_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Coursemodule::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            // How to get back courseName instead of course_id
            // $this->course->courseName, gives "Trying to get property of non-object"
            'Course_id' => $this->Course_id,
            'Module_id' => $this->Module_id,
        ]);

        return $dataProvider;
    }
}
