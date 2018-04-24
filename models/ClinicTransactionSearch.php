<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MembershipManagement;

/**
 * MembershipManagementSearch represents the model behind the search form about `common\models\MembershipManagement`.
 */
class ClinicTransactionSearch extends MembershipManagement {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'clinic_id', 'plan_id', 'start_time', 'end_time', 'created_at', 'updated_at', 'lab_id'], 'integer'],
            [['gateway_name', 'txn_id'], 'safe'],
            [['amount_paid' ], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = MembershipManagement::find();
        
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
            'clinic_id' => $this->clinic_id,
            'plan_id' => $this->plan_id,
            'amount_paid' => $this->amount_paid,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'gateway_name', $this->gateway_name])
                ->andFilterWhere(['like', 'txn_id', $this->txn_id]);
        $dataProvider->sort = ['defaultOrder' => ["created_at" => "DESC"]]; 
        return $dataProvider;
    }

}
