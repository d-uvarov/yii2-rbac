<?php

namespace uvarov\yii2rbac\models;

use Yii;
use yii\rbac\Permission;

/**
 * This is the model class for table "auth_item".
 *
 * @property string   $name
 * @property int      $type
 * @property string   $description
 * @property string   $rule_name
 * @property resource $data
 * @property int      $created_at
 * @property int      $updated_at
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rule_name'], 'default', 'value' => null],
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique'],
//            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthRule::className(), 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }

    public function init()
    {
        $this->type = Permission::TYPE_ROLE;
        parent::init();
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'        => 'Name',
            'type'        => 'Type',
            'description' => 'Description',
            'rule_name'   => 'Rule Name',
            'data'        => 'Data',
            'created_at'  => 'Created At',
            'updated_at'  => 'Updated At',
        ];
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
