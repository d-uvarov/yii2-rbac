<?php

namespace uvarov\yii2rbac\controllers;

use Yii;
use uvarov\yii2rbac\models\Relations;
use uvarov\yii2rbac\models\RelationsSearch;
use yii\web\NotFoundHttpException;

/**
 * RelationsController implements the CRUD actions for Relations model.
 */
class RelationsController extends MainController
{
    /**
     * Lists all Relations models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new RelationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Relations model.
     *
     * @param string $parent
     * @param string $child
     *
     * @return mixed
     */
    public function actionView($parent, $child)
    {
        return $this->render('view', [
            'model' => $this->findModel($parent, $child),
        ]);
    }

    /**
     * Creates a new Relations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Relations();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'parent' => $model->parent, 'child' => $model->child]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Relations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $parent
     * @param string $child
     *
     * @return mixed
     */
    public function actionUpdate($parent, $child)
    {
        $model = $this->findModel($parent, $child);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'parent' => $model->parent, 'child' => $model->child]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Relations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $parent
     * @param string $child
     *
     * @return mixed
     */
    public function actionDelete($parent, $child)
    {
        $this->findModel($parent, $child)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Relations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $parent
     * @param string $child
     *
     * @return Relations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($parent, $child)
    {
        if (($model = Relations::findOne(['parent' => $parent, 'child' => $child])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
