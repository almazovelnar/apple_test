<?php

use yii\widgets\ActiveForm;

$this->title = 'New apple';

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'color')->textInput() ?>

<div class="float-right">
    <?= \yii\helpers\Html::submitButton('Save', [
        'class' => 'btn btn-success'
    ]) ?>
</div>

<?php ActiveForm::end() ?>
