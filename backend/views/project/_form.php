<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reporter_id')->dropDownList(ArrayHelper::map($options['user'], 'id', 'username'))->label('Reporter') ?>

    <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map($options['status'], 'id', 'name'))->label('Status') ?>

    <?= $form->field($model, 'priority_id')->dropDownList(ArrayHelper::map($options['priority'], 'id', 'name'))->label('Priority') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
