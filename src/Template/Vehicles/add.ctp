<?php $this->assign('title', 'Vehicle Master - New Registration'); ?>

<div class="card">
    <div class="card-header">
        <h4>Add New Vehicle</h4>
    </div>
    <div class="card-body">
        <?= $this->Form->create($vehicle, ['type' => 'file']) ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control('vehicle_code', [
                        'class' => 'form-control',
                        'label' => ['text' => 'Vehicle ID/Code (Auto-generated)', 'class' => 'form-label'],
                        'readonly' => true,
                        'placeholder' => 'Auto-generated'
                    ]) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control('registration_no', [
                        'class' => 'form-control',
                        'label' => ['text' => 'Registration Number', 'class' => 'form-label'],
                        'placeholder' => 'RJ-14-AB-1234'
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control('registration_period', [
                        'type' => 'date',
                        'class' => 'form-control',
                        'label' => ['text' => 'Registration Period To', 'class' => 'form-label']
                    ]) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control('purchase_date', [
                        'type' => 'date',
                        'class' => 'form-control',
                        'label' => ['text' => 'Purchase Date', 'class' => 'form-label']
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $this->Form->control('vehicle_type', [
                        'type' => 'select',
                        'options' => [
                            'Car' => 'Car',
                            'SUV' => 'SUV',
                            'Bus' => 'Bus',
                            'Jeep' => 'Jeep',
                            'Truck' => 'Truck',
                            'Motorcycle' => 'Motorcycle'
                        ],
                        'empty' => 'Select Vehicle Type',
                        'class' => 'form-control form-select',
                        'label' => ['text' => 'Vehicle Type', 'class' => 'form-label']
                    ]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $this->Form->control('fuel_type', [
                        'type' => 'select',
                        'options' => [
                            'Petrol' => 'Petrol',
                            'Diesel' => 'Diesel',
                            'CNG' => 'CNG',
                            'Electric' => 'Electric',
                            'Hybrid' => 'Hybrid'
                        ],
                        'empty' => 'Select Fuel Type',
                        'class' => 'form-control form-select',
                        'label' => ['text' => 'Fuel Type', 'class' => 'form-label']
                    ]) ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= $this->Form->control('seating_capacity', [
                        'type' => 'number',
                        'class' => 'form-control',
                        'label' => ['text' => 'Seating Capacity', 'class' => 'form-label'],
                        'min' => 1
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control('make_model', [
                        'class' => 'form-control',
                        'label' => ['text' => 'Manufacturer & Model', 'class' => 'form-label'],
                        'placeholder' => 'e.g., Maruti Suzuki Swift'
                    ]) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control('engine_no', [
                        'class' => 'form-control',
                        'label' => ['text' => 'Engine Number', 'class' => 'form-label']
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control('chassis_no', [
                        'class' => 'form-control',
                        'label' => ['text' => 'Chassis Number', 'class' => 'form-label']
                    ]) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control('fitness_period', [
                        'type' => 'date',
                        'class' => 'form-control',
                        'label' => ['text' => 'Fitness Period To', 'class' => 'form-label']
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control('assigned_department', [
                        'class' => 'form-control',
                        'label' => ['text' => 'Assigned Department/Office', 'class' => 'form-label']
                    ]) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $this->Form->control('assigned_officer', [
                        'class' => 'form-control',
                        'label' => ['text' => 'Assigned Officer', 'class' => 'form-label']
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= $this->Form->control('status', [
                'type' => 'select',
                'options' => [
                    'Active' => 'Active',
                    'In-Service' => 'In-Service',
                    'Unused' => 'Unused'
                ],
                'default' => 'Active',
                'class' => 'form-control form-select',
                'label' => ['text' => 'Present Status', 'class' => 'form-label']
            ]) ?>
        </div>

        <hr>
        <h5>Purchase Details</h5>

        <!-- Purchase details would be handled in a separate form/controller -->

        <div class="form-actions">
            <?= $this->Form->submit('Save Vehicle', ['class' => 'btn btn-primary']) ?>
            <?= $this->Form->button('Save as Draft', ['type' => 'submit', 'name' => 'draft', 'class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>