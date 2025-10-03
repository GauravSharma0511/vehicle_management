<?php
// src/Controller/VehiclesController.php
namespace App\Controller;

use App\Controller\AppController;

class VehiclesController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'contain' => ['PurchaseDetails', 'Insurance'],
            'conditions' => []
        ];

        // Filter by status if requested
        if ($this->request->getQuery('status')) {
            $this->paginate['conditions']['status'] = $this->request->getQuery('status');
        }

        $vehicles = $this->paginate($this->Vehicles);
        $this->set(compact('vehicles'));
    }

    public function add()
    {
        $vehicle = $this->Vehicles->newEntity();
        if ($this->request->is('post')) {
            $vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->getData());

            // Auto-generate vehicle code
            if (empty($vehicle->vehicle_code)) {
                $vehicle->vehicle_code = 'VH' . str_pad($this->Vehicles->find()->count() + 1, 3, '0', STR_PAD_LEFT);
            }

            if ($this->Vehicles->save($vehicle)) {
                $this->Flash->success('Vehicle has been added.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to add the vehicle.');
        }
        $this->set(compact('vehicle'));
    }

    public function view($id = null)
    {
        $vehicle = $this->Vehicles->get($id, [
            'contain' => ['PurchaseDetails', 'Insurance', 'Maintenance', 'FuelLogs', 'Accidents']
        ]);
        $this->set(compact('vehicle'));
    }

    public function edit($id = null)
    {
        $vehicle = $this->Vehicles->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->getData());
            if ($this->Vehicles->save($vehicle)) {
                $this->Flash->success('Vehicle has been updated.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to update the vehicle.');
        }
        $this->set(compact('vehicle'));
    }

    public function condemn($id = null)
    {
        $vehicle = $this->Vehicles->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicle->status = 'Condemned';
            if ($this->Vehicles->save($vehicle)) {
                $this->Flash->success('Vehicle has been condemned.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to condemn the vehicle.');
        }
        $this->set(compact('vehicle'));
    }

    public function isAuthorized($user)
    {
        // Admin and vehicle managers can access all vehicle actions
        if (in_array($user['role'], ['admin', 'vehicle_manager'])) {
            return true;
        }

        // Auditors can only view vehicles
        if ($user['role'] === 'auditor' && in_array($this->request->getParam('action'), ['index', 'view'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }
}