<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $form yii\widgets\ActiveForm */

$users = [];
foreach ( \common\models\User::find()->all() as $user) {
    $users[] = $user->username;
}

$project = [];
foreach (\common\models\Project::find()->all() as $proj) {
    $project[] = $proj->name;
}

$status = [];
foreach ( \common\models\Status::find()->all() as $s) {
    $status[] = $s->name;
}

$priority = [];
foreach ( \common\models\Priority::find()->all() as $p) {
    $priority[] = $p->name;
}

?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reporter_id')->dropDownList([$users])->label('Reporter') ?>

    <?= $form->field($model, 'project_id')->dropDownList([$project])->label('Project') ?>

    <?= $form->field($model, 'status_id')->dropDownList([$status])->label('Status')  ?>

    <?= $form->field($model, 'priority_id')->dropDownList([$priority])->label('Priority') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
