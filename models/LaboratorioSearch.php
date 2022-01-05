<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Laboratorio;

/**
 * LaboratorioSearch represents the model behind the search form of `app\models\Laboratorio`.
 */
class LaboratorioSearch extends Laboratorio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_LABORATORIO'], 'integer'],
            [['NOMBRE_LAB'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Laboratorio::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID_LABORATORIO' => $this->ID_LABORATORIO,
        ]);

        $query->andFilterWhere(['like', 'NOMBRE_LAB', $this->NOMBRE_LAB]);

        return $dataProvider;
    }
}
