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

    <?= $form->field($model, 'author_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <?= $form->field($model, 'reporter_id')->dropDownList([$users])?>

    <?= $form->field($model, 'status_id')->dropDownList([$status]) ?>

    <?= $form->field($model, 'priority_id')->dropDownList([$priority]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
