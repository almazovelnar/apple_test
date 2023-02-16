<?php

namespace backend\controllers;

use Yii;
use RuntimeException;
use yii\web\Controller;
use common\models\Apple;
use yii\data\ActiveDataProvider;
use common\services\AppleService;
use common\repositories\AppleRepository;

/**
 * Site controller
 */
class AppleController extends Controller
{
    public $appleRepository;
    public $appleService;

    public function __construct(
        $id,
        $module,
        AppleRepository $appleRepository,
        AppleService $appleService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);

        $this->appleRepository = $appleRepository;
        $this->appleService = $appleService;
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Apple::find()
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    public function actionCreate()
    {
        $form = new Apple();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $form->save();
                return $this->redirect(['index']);
            } catch (RuntimeException $e) {
                Yii::$app->session->setFlash('notification', $e->getMessage());
                return $this->goBack();
            }
        }

        return $this->render('create', [
            'model' => $form
        ]);
    }

    public function actionDelete(int $id)
    {
        $apple = $this->appleRepository->get($id);

        try {
            $this->appleService->remove($apple);
            Yii::$app->session->setFlash('notification', 'Apple deleted successfully');
            return $this->redirect(['index']);
        } catch (RuntimeException $e) {
            Yii::$app->session->setFlash('notification', $e->getMessage());
            return $this->redirect(['index']);
        }
    }

    public function actionEat(int $id, int $percent)
    {
        $apple = $this->appleRepository->get($id);

        try {
            $this->appleService->eat($apple, $percent);
            return $this->redirect(['index']);
        } catch (RuntimeException $e) {
            Yii::$app->session->setFlash('notification', $e->getMessage());
            return $this->redirect(['index']);
        }
    }

    public function actionDrop(int $id)
    {
        $apple = $this->appleRepository->get($id);

        try {
            $this->appleService->drop($apple);
            Yii::$app->session->setFlash('notification', 'Apple dropped successfully');
            return $this->redirect(['index']);
        } catch (RuntimeException $e) {
            Yii::$app->session->setFlash('notification', $e->getMessage());
            return $this->redirect(['index']);
        }
    }
}
