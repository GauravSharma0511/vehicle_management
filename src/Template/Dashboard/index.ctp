<?php $this->assign('title', 'Dashboard'); ?>

<div class="stats-row">
    <div class="stat-card">
        <span class="stat-number"><?= $totalVehicles ?></span>
        <div class="stat-label">Total Vehicles</div>
    </div>
    <div class="stat-card">
        <span class="stat-number"><?= $activeVehicles ?></span>
        <div class="stat-label">Active Vehicles</div>
    </div>
    <div class="stat-card">
        <span class="stat-number"><?= $totalDrivers ?></span>
        <div class="stat-label">Total Drivers</div>
    </div>
    <div class="stat-card">
        <span class="stat-number"><?= $activeDrivers ?></span>
        <div class="stat-label">Active Drivers</div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Recent Maintenance Activities</h4>
            </div>
            <div class="card-body">
                <?php if (empty($recentMaintenance)): ?>
                    <p>No recent maintenance activities.</p>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Vehicle</th>
                                <th>Service Date</th>
                                <th>Service Type</th>
                                <th>Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentMaintenance as $maintenance): ?>
                            <tr>
                                <td><?= h($maintenance->vehicle->registration_no) ?></td>
                                <td><?= h($maintenance->service_date->format('Y-m-d')) ?></td>
                                <td><?= h($maintenance->service_type) ?></td>
                                <td>₹<?= number_format($maintenance->cost_incurred, 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Upcoming Alerts</h4>
            </div>
            <div class="card-body">
                <?php if (empty($alerts)): ?>
                    <p>No upcoming alerts.</p>
                <?php else: ?>
                    <ul class="list-unstyled">
                        <?php foreach ($alerts as $alert): ?>
                        <li class="mb-2">
                            <div class="alert alert-warning">
                                <strong><?= h($alert->alert_type) ?></strong><br>
                                Due: <?= h($alert->due_date->format('Y-m-d')) ?><br>
                                <small><?= h($alert->description) ?></small>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- src/Template/Vehicles/index.ctp -->
<?php $this->assign('title', 'Vehicle Master'); ?>

<div class="card">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h4>Vehicle List</h4>
            <?= $this->Html->link('Add New Vehicle', ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="card-body">
        <!-- Search and Filter -->
        <div class="row mb-3">
            <div class="col-md-4">
                <?= $this->Form->create(null, ['type' => 'get', 'class' => 'form-inline']) ?>
                <?= $this->Form->control('status', [
                    'type' => 'select',
                    'options' => [
                        '' => 'All Status',
                        'Active' => 'Active',
                        'In-Service' => 'In-Service',
                        'Condemned' => 'Condemned',
                        'Unused' => 'Unused'
                    ],
                    'value' => $this->request->getQuery('status'),
                    'class' => 'form-control form-select',
                    'label' => false,
                    'onchange' => 'this.form.submit()'
                ]) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('vehicle_code', 'Vehicle ID') ?></th>
                        <th><?= $this->Paginator->sort('registration_no', 'Registration No.') ?></th>
                        <th><?= $this->Paginator->sort('vehicle_type', 'Type') ?></th>
                        <th><?= $this->Paginator->sort('make_model', 'Make/Model') ?></th>
                        <th><?= $this->Paginator->sort('status', 'Status') ?></th>
                        <th>Driver</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vehicles as $vehicle): ?>
                    <tr>
                        <td><?= h($vehicle->vehicle_code) ?></td>
                        <td><?= h($vehicle->registration_no) ?></td>
                        <td><?= h($vehicle->vehicle_type) ?></td>
                        <td><?= h($vehicle->make_model) ?></td>
                        <td>
                            <span class="badge <?= $vehicle->status === 'Active' ? 'badge-success' : ($vehicle->status === 'Condemned' ? 'badge-danger' : 'badge-secondary') ?>">
                                <?= h($vehicle->status) ?>
                            </span>
                        </td>
                        <td>
                            <!-- Current driver would be fetched from driver_assignments -->
                            -
                        </td>
                        <td>
                            <?= $this->Html->link('View', ['action' => 'view', $vehicle->vehicle_id], ['class' => 'btn btn-info btn-sm']) ?>
                            <?= $this->Html->link('Edit', ['action' => 'edit', $vehicle->vehicle_id], ['class' => 'btn btn-warning btn-sm']) ?>
                            <?php if ($vehicle->status !== 'Condemned'): ?>
                            <?= $this->Html->link('Condemn', ['action' => 'condemn', $vehicle->vehicle_id], [
                                'class' => 'btn btn-danger btn-sm',
                                'confirm' => 'Are you sure you want to condemn this vehicle?'
                            ]) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?= $this->Paginator->first('<< First') ?>
            <?= $this->Paginator->prev('< Previous') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('Next >') ?>
            <?= $this->Paginator->last('Last >>') ?>
        </div>
    </div>
</div>