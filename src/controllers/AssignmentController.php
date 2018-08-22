<?php

namespace uvarov\yii2rbac\controllers;

use Yii;
use uvarov\yii2rbac\models\Assignment;
use uvarov\yii2rbac\models\AssignmentSearch;
use yii\web\NotFoundHttpException;


/**
 * AssignmentController implements the CRUD actions for Assignment model.
 */
class AssignmentController extends MainController
{
    /**
     * Lists all Assignment models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new AssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Assignment model.
     *
     * @param string $itemName
     * @param string $userId
     *
     * @return mixed
     */
    public function actionView($itemName, $userId)
    {
        return $this->render('view', [
            'model' => $this->findModel($itemName, $userId),
        ]);
    }

    /**
     * Creates a new Assignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Assignment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Assignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $itemName
     * @param string $userId
     *
     * @return mixed
     */
    public function actionUpdate($item_name, $user_id)
    {
        $model = $this->findModel($item_name, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Assignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $itemName
     * @param string $userId
     *
     * @return mixed
     */
    public function actionDelete($itemName, $userId)
    {
        $this->findModel($itemName, $userId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Assignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $itemName
     * @param string $userId
     *
     * @return Assignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($itemName, $userId)
    {
        if (($model = Assignment::findOne(['item_name' => $itemName, 'user_id' => $userId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
