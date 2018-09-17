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
     * @var array
     */
    protected $db = null;

    /**
     * @var array
     */
    protected $user = null;

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
        parent::init();
        Yii::setAlias('@rbac', __DIR__);

        if (is_null($this->db)) {
            throw new HttpException(500, "Db not set");
        }

        if (is_null($this->user)) {
            throw new HttpException(500, "User not set");
        }

        Yii::$app->set('db', $this->db);
        Yii::$app->set('user', $this->user);


        // Register Error handler
        Yii::configure($this, [
            'components' => [
                'errorHandler' => [
                    'class' => ErrorHandler::class,
                ],
            ],
        ]);

        /** @var ErrorHandler $handler */
        $handler = $this->get('errorHandler');
        \Yii::$app->set('errorHandler', $handler);
        $handler->register();

        $authManager = Yii::$app->getAuthManager();

        if (is_null($authManager)) {
            throw new HttpException(500, "AuthManager is empty");
        }

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

    /**
     * @param array $db
     */
    public function setDb(array $db)
    {
        $this->db = $db;
    }

    /**
     * @param array $user
     */
    public function setUser(array $user)
    {
        $this->user = $user;
    }
}
