<?php

namespace uvarov\yii2rbac\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "auth_item_child".
 *
 * @property string   $parent
 * @property string   $child
 *
 * @property AuthItem $parent0
 * @property AuthItem $child0
 */
class Relations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_item_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent', 'child'], 'unique', 'targetAttribute' => ['parent', 'child']],
            [
                ['parent'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Role::class,
                'targetAttribute' => ['parent' => 'name'],
            ],
            [
                ['child'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Role::class,
                'filter'          => function (Query $query) {
                    $query->where('`type`=1 OR `type`=2');
                },
                'targetAttribute' => ['child' => 'name'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parent' => 'Parent',
            'child'  => 'Child',
        ];
    }

    /**
     * @inheritdoc
     * @return RelationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RelationsQuery(get_called_class());
    }
}
