<?php

namespace uvarov\yii2rbac\models;


/**
 * Class Permission
 *
 * @package uvarov\yii2rbac\models
 */
class Permission extends AuthItem
{
    public function init()
    {
        $this->type = \yii\rbac\Permission::TYPE_PERMISSION;
        parent::init();
    }

    /**
     * @inheritdoc
     * @return PermissionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return (new PermissionQuery(get_called_class()))->andWhere('type=' . \yii\rbac\Permission::TYPE_PERMISSION);
    }
}
