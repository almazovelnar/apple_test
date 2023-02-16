<?php
    /** @var ActiveDataProvider $dataProvider */

use common\enum\Status;
use common\helpers\LabelHelper;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Apples';

$this->registerJs("
    $('.btn-eat').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var percent = prompt('How much percent you want eat? (Write in percent)');
        percent = parseInt(percent);
        if (percent) {
            window.location.href = url + '&percent=' + percent;
        }
    });
");
?>

<div class="card-header">
    <?php if($notification = Yii::$app->session->getFlash('notification')): ?>
        <div class="alert alert-secondary"><?= $notification ?></div>
    <?php endif; ?>
    <a href="<?= Url::to(['apples/create']) ?>" class="btn btn-primary">Create apple</a>
</div>

<div class="card-body">
    <?= yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'color',
            [
                'label' => 'Status',
                'value' => function ($data) {
                    return LabelHelper::generate(
                            !$data->isEated() ? Status::get($data->status) : 'Is eaten',
                            Status::label($data->status)
                    );
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Eaten',
                'value' => function ($data) {
                    return $data->eaten . '%';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{eat} {drop} {delete}",
                'buttons' => [
                    'eat' => function ($url, $data) {
                        if (!$data->isEated()) {
                            return Html::a("Eat", $url, [
                                'class' => 'btn btn-success btn-eat'
                            ]);
                        }
                        return false;
                    },
                    'drop' => function ($url, $data) {
                        if ($data->status == Status::ON_TREE) {
                            return Html::a("Drop", $url, ['class' => 'btn btn-warning']);
                        }

                        return false;
                    },
                    'delete' => function ($url, $data) {
                        if ($data->isRotten() || $data->isEated()) {
                            return Html::a("Delete", $url, [
                                'class' => 'btn btn-danger',
                                'data-confirm' => 'Do you want delete this apple?'
                            ]);
                        }

                        return false;
                    }
                ]
            ],
        ]
    ]) ?>
</div>