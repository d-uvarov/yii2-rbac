<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model uvarov\yii2rbac\models\Relations */

$this->title = 'Update Relations: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Relations', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->parent,
    'url'   => ['view', 'parent' => $model->parent, 'child' => $model->child],
];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
