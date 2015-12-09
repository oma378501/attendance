<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StudentModule;

/**
 * StudentModuleSearch represents the model behind the search form about `app\models\StudentModule`.
 */
class StudentModuleSearch extends StudentModule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Student_id', 'Module_id'], 'integer'],
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
        $query = StudentModule::find();

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
            'Student_id' => $this->Student_id,
            'Module_id' => $this->Module_id,
        ]);

        return $dataProvider;
    }
}
