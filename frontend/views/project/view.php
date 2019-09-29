<?php

use common\models\Priority;
use common\models\Status;
use common\models\User;
use yii\grid\GridView;
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
            'name',
            'description',
            'author_id',
            'reporter_id',
            //'status_id',
            //'priority_id',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
