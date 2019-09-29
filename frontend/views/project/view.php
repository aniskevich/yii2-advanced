<?php

use common\models\Priority;
use common\models\Project;
use common\models\Status;
use common\models\User;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            [
                'label' => 'Author',
                'attribute' => 'author_id',
                'value' => function($model) {
                    return User::findOne($model->author_id)->username;
                }
            ],
            [
                'label' => 'Reporter',
                'attribute' => 'reporter_id',
                'value' => function($model) {
                    return User::findOne($model->reporter_id)->username;
                }
            ],
            [
                'label' => 'Status',
                'attribute' => 'status_id',
                'value' => function($model) {
                    return Status::findOne($model->status_id)->name;
                }
            ],
            [
                'label' => 'Priority',
                'attribute' => 'priority_id',
                'value' => function($model) {
                    return Priority::findOne($model->priority_id)->name;
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <h4>Tasks:</h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a($model->name, ['task/view', 'id' => $model->id]);
                }
            ],
            'description',
            [
                'label' => 'Author',
                'attribute' => 'author_id',
                'filter'=>ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'),
                'value' => function($model) {
                    return User::findOne($model->author_id)->username;
                }
            ],
            [
                'label' => 'Reporter',
                'attribute' => 'reporter_id',
                'filter'=>ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'),
                'value' => function($model) {
                    return User::findOne($model->reporter_id)->username;
                }
            ],
            [
                'label' => 'Project',
                'attribute' => 'project_id',
                'filter'=>ArrayHelper::map(Project::find()->asArray()->all(), 'id', 'name'),
                'value' => function($model) {
                    return Project::findOne($model->project_id)->name;
                }
            ],
            [
                'label' => 'Status',
                'attribute' => 'status_id',
                'filter'=>ArrayHelper::map(Status::find()->asArray()->all(), 'id', 'name'),
                'value' => function($model) {
                    return Status::findOne($model->status_id)->name;
                }
            ],
            [
                'label' => 'Priority',
                'attribute' => 'priority_id',
                'filter'=>ArrayHelper::map(Priority::find()->asArray()->all(), 'id', 'name'),
                'value' => function($model) {
                    return Priority::findOne($model->priority_id)->name;
                }
            ],
            //'created_at',
            //'updated_at',

        ],
    ]); ?>

</div>
