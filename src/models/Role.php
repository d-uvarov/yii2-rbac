<?php

namespace uvarov\yii2rbac\models;

use yii\rbac\Permission;

/**
 * Class Role
 *
 * @package uvarov\yii2rbac\models
 */
class Role extends AuthItem
{
    public function init()
    {
        $this->type = Permission::TYPE_ROLE;
        parent::init();
    }

    /**
     * @inheritdoc
     * @return RoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return (new RoleQuery(get_called_class()));
    }
}
