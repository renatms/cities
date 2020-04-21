<?php

namespace app\controllers;

use app\models\Comment;
use app\models\CommentForm;
use app\models\LoginForm;
use app\models\SignupForm;
use Yii;
use app\models\City;
use app\models\CitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SiteController implements the CRUD actions for City model.
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all City models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new CitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single City model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $comments = Comment::find()->where(['city_id' => $id])->all();

        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->request->Get('user_like')) {

                $city = Yii::$app->request->Get('id');
                $user = Yii::$app->request->Get('user_like');
                $comment_id = Yii::$app->request->Get('comm_id');


                $like = Comment::find()->where(['city_id' => $city])
                    ->andWhere(['user_id' => $user])
                    ->andWhere(['id' => $comment_id])->one();

                if ($like->rating == 0) {
                    $like->rating = 1;
                    $like->save(false);
                } else {
                    $like->rating = 0;
                    $like->save(false);
                }
            }
        };

        return $this->render('view', [
            'model' => $this->findModel($id),
            'comments' => $comments,
            //'comment' => $comment,
        ]);
    }

    public function actionSetComment($id)
    {
        $comment = new CommentForm;

        if (Yii::$app->request->isPost) {
            $comment->load(Yii::$app->request->post());
            $comment->image = UploadedFile::getInstance($comment, 'image');
            $generateFile = strtolower(md5(uniqid($comment->image->baseName)) . '.' . $comment->image->extension);
            $comment->image = $generateFile;
            $comment->upload($comment->image);
            $comment->saveComment($id);
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('comment', [
            //'model' => $this->findModel($id),
            'comment' => $comment,
        ]);
    }

    /**
     * Creates a new City model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new City();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing City model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing City model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the City model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return City the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    /**
     * @return string
     */
    public
    function actionAbout()
    {
        $model = new City();

        return $this->render('about', [
            'model' => $model
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public
    function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    /**
     * @return string|\yii\web\Response
     */
    public
    function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * @return \yii\web\Response
     */
    public
    function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    protected function findModel($id)
    {
        if (($model = City::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
