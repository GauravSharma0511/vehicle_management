<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MaintenanceTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setTable('maintenance');
        $this->setPrimaryKey('maintenance_id');

        // Add this line for vehicle association
        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'INNER'
        ]);

        // (Optional) Add relation for services vendor if a table exists
        // $this->belongsTo('Vendors', [
        //     'foreignKey' => 'vendor_id',
        //     'joinType' => 'LEFT'
        // ]);

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('maintenance_id')
            ->allowEmptyString('maintenance_id', null, 'create');

        $validator
            ->integer('vehicle_id')
            ->requirePresence('vehicle_id', 'create')
            ->notEmptyString('vehicle_id');

        $validator
            ->date('service_date')
            ->requirePresence('service_date', 'create')
            ->notEmptyDate('service_date');

        $validator
            ->scalar('service_type')
            ->maxLength('service_type', 100)
            ->requirePresence('service_type', 'create')
            ->notEmptyString('service_type');

        $validator
            ->numeric('cost_incurred')
            ->allowEmptyString('cost_incurred');

        return $validator;
    }
}
