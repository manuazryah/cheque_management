<?php

namespace backend\modules\content\controllers;

use Yii;
use common\models\Content;
use common\models\ContentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ContentController extends Controller {

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ];
        }

        /**
         * Lists all Content models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new ContentSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single Content model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Content model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Content();

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        $banner_image = UploadedFile::getInstance($model, 'banner_image');
                        $small_image = UploadedFile::getInstance($model, 'small_image');
                        $large_image = UploadedFile::getInstance($model, 'large_image');
                        $model->banner_image = $banner_image->extension;
                        $model->small_image = $small_image->extension;
                        $model->large_image = $large_image->extension;
                        if ($model->save()) {
                                $this->Upload($model, $banner_image, $small_image, $large_image);
                        }
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing Content model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        $banner_image = UploadedFile::getInstance($model, 'banner_image');
                        $small_image = UploadedFile::getInstance($model, 'small_image');
                        $large_image = UploadedFile::getInstance($model, 'large_image');
                        $data = Content::findOne($id);
                        if (empty($banner_image)) {
                                $model->banner_image = $data->banner_image;
                        } else {
                                $model->banner_image = $banner_image->extension;
                        }
                        if (empty($small_image)) {
                                $model->small_image = $data->small_image;
                        } else {
                                $model->small_image = $small_image->extension;
                        }
                        if (empty($large_image)) {
                                $model->large_image = $data->large_image;
                        } else {
                                $model->large_image = $large_image->extension;
                        }
                        if ($model->save()) {
                                $this->Upload($model, $banner_image, $small_image, $large_image);
                        }
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Upload images to content.
         */
        public function Upload($model, $banner_image, $small_image, $large_image) {
                $path = 'uploads/content/' . $model->id;
                if (!is_dir($path)) {
                        mkdir($path);
                }
                if (!empty($banner_image)) {
                        if (file_exists($path . '/banner_image.' . $model->banner_image)) {
                                unlink($path . '/banner_image.' . $model->banner_image);
                        }
                        $banner_image->saveAs($path . '/banner_image.' . $model->banner_image);
                }
                if (!empty($small_image)) {
                        if (file_exists($path . '/small_image.' . $model->small_image)) {
                                unlink($path . '/small_image.' . $model->small_image);
                        }
                        $small_image->saveAs($path . '/small_image.' . $model->small_image);
                }
                if (!empty($large_image)) {
                        if (file_exists($path . '/large_image.' . $model->large_image)) {
                                unlink($path . '/large_image.' . $model->large_image);
                        }
                        $large_image->saveAs($path . '/large_image.' . $model->large_image);
                }
                return True;
        }

        /**
         * Deletes an existing Content model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the Content model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Content the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Content::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
