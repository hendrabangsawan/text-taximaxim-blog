<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Post;

class PostController extends Controller
{
    public function actionView($id)
    {
      $model = Post::findOne($id);
      if ($model === null) {
          throw new NotFoundHttpException;
      }

      return $this->render('view', [
          'model' => $model,
      ]);
    }

    public function actionCreate()
    {
      $model = new Post;

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['view', 'id' => $model->id]);
      } else {
          return $this->render('create', [
              'model' => $model,
          ]);
      }
    }
}