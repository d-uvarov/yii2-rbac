<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 18.09.2018
 * Time: 0:01
 */

namespace uvarov\yii2rbac\models;


/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property int    $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property int    $created_at
 * @property int    $updated_at
 */
class AuthItem extends \yii\db\ActiveRecord
{
    const COL_TYPE        = 'type';
    const COL_NAME        = 'name';
    const COL_DESCRIPTION = 'name';
    const COL_RULE_NAME   = 'rule_name';
    const COL_DATA        = 'data';
    const COL_CREATED_AT  = 'created_at';
    const COL_UPDATED_AT  = 'updated_at';

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
            [['created_at', 'updated_at'], 'default', 'value' => time()],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique'],
//            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthRule::className(), 'targetAttribute' => ['rule_name' => 'name']],
        ];
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
}