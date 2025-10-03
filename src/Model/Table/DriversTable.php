<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class DriversTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('drivers');
        $this->setPrimaryKey('driver_id');

        $this->hasMany('DriverAssignments', [
            'foreignKey' => 'driver_id',
            'className' => 'DriverAssignments'
        ]);

        $this->hasMany('FuelLogs', [
            'foreignKey' => 'driver_id',
            'className' => 'FuelLogs'
        ]);

        $this->hasMany('Accidents', [
            'foreignKey' => 'driver_id',
            'className' => 'Accidents'
        ]);

        $this->hasMany('DriverComplaints', [
            'foreignKey' => 'driver_id',
            'className' => 'DriverComplaints'
        ]);

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('license_no')
            ->maxLength('license_no', 100)
            ->allowEmptyString('license_no')
            ->add('license_no', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('contact_no')
            ->maxLength('contact_no', 20)
            ->allowEmptyString('contact_no');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->allowEmptyString('status');

        return $validator;
    }
}
