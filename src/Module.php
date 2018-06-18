<?php

namespace uvarov\yii2rbac;

use Yii;
use yii\web\HttpException;

/**
 * Class Module
 *
 * @package uvarov\yii2rbac\modules\rbac
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!Yii::$app->user->can('admin')) {
            throw new HttpException(403);
        }

        // custom initialization code goes here

        $this->layout                    = '@uvarov/yii2rbac/views/layouts/main';
        Yii::$app->assetManager->bundles = [
            'yii\web\JqueryAsset',
            'yii\bootstrap\BootstrapPluginAsset',
            'yii\bootstrap\BootstrapAsset',
        ];
    }
}
