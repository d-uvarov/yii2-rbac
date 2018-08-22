<?php

namespace uvarov\yii2rbac;

use Yii;
use yii\web\HttpException;
use yii\web\ErrorHandler;

/**
 * Class Module
 *
 * @package uvarov\yii2rbac\modules\rbac
 */
class Module extends \yii\base\Module
{
    /**
     * @var
     */
    public $db;

    /**
     * @var
     */
    public $user;

    /**
     * @var string
     */
    public $layout = 'main';

    /**
     * @throws HttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        Yii::setAlias('@rbac', __DIR__);

        // TODO: добавить обязательность.
        if (!Yii::$app->has('db')) {
            Yii::$app->set('db', $this->db);
        }

        // TODO: добавить обязательность.
        Yii::$app->set('user', $this->user);

        parent::init();

        // Register Error handler
        Yii::configure($this, [
            'components' => [
                'errorHandler' => [
                    'class'       => ErrorHandler::class,
                ],
            ],
        ]);

        /** @var ErrorHandler $handler */
        $handler = $this->get('errorHandler');
        \Yii::$app->set('errorHandler', $handler);
        $handler->register();

        $user = Yii::$app->getUser();

        if ($user->getIsGuest() || !$user->can('admin')) {
            throw new HttpException(403);
        }

        // custom initialization code goes here
        Yii::$app->assetManager->bundles = [
            'yii\web\JqueryAsset',
            'yii\bootstrap\BootstrapPluginAsset',
            'yii\bootstrap\BootstrapAsset',
        ];
    }
}
