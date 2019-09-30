<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use common\models\Status;
use common\models\Priority;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                    return Html::a($model->name, ['project/view', 'id' => $model->id]);
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
