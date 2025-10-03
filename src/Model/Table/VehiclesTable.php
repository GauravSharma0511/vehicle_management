<?php
// src/Model/Table/VehiclesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class VehiclesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('vehicles');
        $this->setPrimaryKey('vehicle_id');

        $this->hasOne('PurchaseDetails', [
            'foreignKey' => 'vehicle_id',
            'className' => 'PurchaseDetails'
        ]);

        $this->hasMany('Insurance', [
            'foreignKey' => 'vehicle_id',
            'className' => 'Insurance'
        ]);

        $this->hasMany('Maintenance', [
            'foreignKey' => 'vehicle_id',
            'className' => 'Maintenance'
        ]);

        $this->hasMany('FuelLogs', [
            'foreignKey' => 'vehicle_id',
            'className' => 'FuelLogs'
        ]);

        $this->hasMany('Accidents', [
            'foreignKey' => 'vehicle_id',
            'className' => 'Accidents'
        ]);

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('vehicle_code')
            ->maxLength('vehicle_code', 50)
            ->requirePresence('vehicle_code', 'create')
            ->notEmptyString('vehicle_code')
            ->add('vehicle_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('registration_no')
            ->maxLength('registration_no', 100)
            ->requirePresence('registration_no', 'create')
            ->notEmptyString('registration_no')
            ->add('registration_no', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('vehicle_type')
            ->maxLength('vehicle_type', 50)
            ->allowEmptyString('vehicle_type');

        $validator
            ->scalar('fuel_type')
            ->maxLength('fuel_type', 50)
            ->allowEmptyString('fuel_type');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->allowEmptyString('status');

        return $validator;
    }
}