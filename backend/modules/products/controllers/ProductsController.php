<?php

namespace backend\modules\products\controllers;

use Yii;
use common\models\Products;
use common\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for products model.
 */
class ProductsController extends Controller {

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
         * Lists all products models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new ProductsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single products model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new products model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new products();

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        $big_image = UploadedFile::getInstance($model, 'big_image');
                        // $small_iamge = UploadedFile::getInstance($model, 'small_image');
                        $model->big_image = $big_image->extension;
                        // $model->small_image = $small_iamge->extension;

                        $model->save();
                        if (!empty($big_image)) {
                                $big_image->saveAs('uploads/products/' . $model->id . '_big' . '.' . $model->big_image);
                        }


                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing products model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);
                $path = 'uploads/products' . $model->id . '_big'.'.' . $model->big_image;
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        $big_image = UploadedFile::getInstance($model, 'big_image');
                        if (empty($big_image)) {
                                $data = Products::findOne($id);
                                $model->big_image = $data->big_image;
                        } else {
                                if (file_exists($path)) {
                                        unlink($path);
                                }
                                $model->big_image = $big_image->extension;
                                $image->saveAs('uploads/products' . $model->id . '_big'.'.' . $model->big_image);
                        }
                        $model->save();
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing products model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
              $model =  $this->findModel($id);
                 $path = 'uploads/products/' . $model->id . '_big'.'.' . $model->big_image;
                 if(file_exists($path)){
                         unlink($path);
                 }
                $model->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the products model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return products the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = products::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
