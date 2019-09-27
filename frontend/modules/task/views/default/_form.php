<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $title */
/* @var $this yii\web\View */
/* @var $model frontend\modules\task\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<h1><?= Html::encode($title) ?></h1>

<?= Html::beginForm(['default/submit'], 'post', ['class' => 'form']); ?>

<?= Html::label('Task name', 'name') ?>
<?= Html::input('text','name', $model->name,['class' => 'form-control']) ?>

<?= Html::label('Description', 'description') ?>
<?= Html::input('text', 'description', $model->description,['class' => 'form-control']) ?>

<?= Html::label('Reporter', 'reporter_id') ?>
<?= Html::dropDownList('reporter_id', $model->reporter_id, ArrayHelper::map($options['user'], 'id', 'username')) ?>

<?= Html::label('Project', 'project_id') ?>
<?= Html::dropDownList('project_id',$model->project_id, ArrayHelper::map($options['project'],'id', 'name')) ?>

<?= Html::label('Status', 'status_id') ?>
<?= Html::dropDownList('status_id',$model->status_id, ArrayHelper::map($options['status'],'id', 'name')) ?>

<?= Html::label('Priority', 'priority_id') ?>
<?= Html::dropDownList('priority_id',$model->priority_id, ArrayHelper::map($options['priority'],'id', 'name')) ?>

<?php if(isset($model->id)) echo Html::hiddenInput('id', $model->id) ?>

<?= Html::submitButton('Save', ['class' => 'submit']) ?>

<?= Html::endForm() ?>
