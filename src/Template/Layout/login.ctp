<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Vehicle Management System</title>
    <?= $this->Html->css('admin') ?>
    <style>
        body {
            background: linear-gradient(135deg, #87CEEB, #4682B4);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
            color: #4682B4;
        }
        .login-header h1 {
            margin: 0;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h1>Vehicle Management System</h1>
            <p>Please login to continue</p>
        </div>

        <?= $this->Flash->render() ?>

        <?= $this->Form->create() ?>
        <div class="form-group">
            <?= $this->Form->control('username', [
                'class' => 'form-control',
                'label' => ['text' => 'Username', 'class' => 'form-label'],
                'required' => true
            ]) ?>
        </div>

        <div class="form-group">
            <?= $this->Form->control('password', [
                'type' => 'password',
                'class' => 'form-control',
                'label' => ['text' => 'Password', 'class' => 'form-label'],
                'required' => true
            ]) ?>
        </div>

        <div class="form-group">
            <?= $this->Form->submit('Login', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</body>
</html>
