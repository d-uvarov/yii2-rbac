# yii2-rbac

console.php
-----------
```php
    'components'          => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'db' => $db,
    ],
    
    'controllerMap' => [
        // Миграции одного из модулей проекта
        'migrate-module-polls' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/polls/migrations',
            'db' => $db
        ],
        'migrate-rbac' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@vendor/d-uvarov/yii2-rbac/src/migrations/',
            'db' => $db
        ],
    ],
```

web.php
---------
    'modules' => [
        'rbac' => [
            'class' => 'uvarov\yii2rbac\Module',
            'db'    => $db,
            'user'  => [
                'class'           => 'app\modules\polls\models\user\AccountUser',
                'identityClass'   => 'app\modules\polls\models\user\AccountIdentity',
                'enableAutoLogin' => true,
                'authTimeout'     => 36000,
            ]
        ],
    ],
    
    
Install
-----------
    ./yii migrate --migrationPath=@yii/rbac/migrations --interactive=0
    ./yii migrate-rbac --interactive=0