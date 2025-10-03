<?php
// src/Controller/DashboardController.php
namespace App\Controller;

use App\Controller\AppController;

class DashboardController extends AppController
{
    public function index()
    {
        // Get dashboard statistics
        $totalVehicles = $this->loadModel('Vehicles')->find()->count();
        $activeVehicles = $this->loadModel('Vehicles')->find()->where(['status' => 'Active'])->count();
        $totalDrivers = $this->loadModel('Drivers')->find()->count();
        $activeDrivers = $this->loadModel('Drivers')->find()->where(['status' => 'Active'])->count();

        // Get upcoming alerts
        $alerts = $this->loadModel('Alerts')->find()
            ->where(['status' => 'Pending'])
            ->where(['due_date >=' => date('Y-m-d')])
            ->order(['due_date' => 'ASC'])
            ->limit(5)
            ->toArray();

        // Recent maintenance
        $recentMaintenance = $this->loadModel('Maintenance')->find()
            ->contain(['Vehicles'])
            ->order(['created' => 'DESC'])
            ->limit(5)
            ->toArray();

        $this->set(compact('totalVehicles', 'activeVehicles', 'totalDrivers', 'activeDrivers', 'alerts', 'recentMaintenance'));
    }

    public function isAuthorized($user)
    {
        // All authenticated users can access dashboard
        return true;
    }
}