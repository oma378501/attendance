<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Attendance;

/**
 * AttendanceSearch represents the model behind the search form about `app\models\Attendance`.
 */
class AttendanceSearch extends Attendance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'present', 'Student_Module_id'], 'integer'],
            [['notes', 'date'], 'safe'],
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
        $query = Attendance::find();

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
            'present' => $this->present,
            'Student_Module_id' => $this->Student_Module_id,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
