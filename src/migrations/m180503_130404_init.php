<?php

use yii\db\Migration;

/**
 * Class m180503_130404_init
 */
class m180503_130404_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // TODO: Добавить проброс userId узера для assign

//        echo `./yii migrate --migrationPath=@yii/rbac/migrations --interactive=0`;

        $auth = Yii::$app->authManager;

        $admin = $auth->createRole('admin');
        $admin->name = 'admin';
        $admin->description = 'Administrator';
        $auth->add($admin);

        $accessCp = $auth->createPermission('accessCP');
        $accessCp->description = 'Access to rbac module';
        $auth->add($accessCp);

        $auth->addChild($admin, $accessCp);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($admin, 1);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180503_130404_init cannot be reverted.\n";

        return false;
    }
}
