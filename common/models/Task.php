<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\Linkable;
use yii\web\Link;
use yii\helpers\Url;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $author_id
 * @property int $reporter_id
 * @property int $project_id
 * @property int $status_id
 * @property int $priority_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $author
 * @property Priority $priority
 * @property User $reporter
 * @property Status $status
 * @property TaskTag[] $taskTags
 */
class Task extends \yii\db\ActiveRecord implements Linkable
{
    private $notification;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function beforeSave($insert)
    {
        if (empty($this->author_id)) $this->author_id = Yii::$app->user->id;
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->notification = 'Task ' . $this->name . ' created';
        } else {
            $this->notification = 'Task ' . $this->name . ' updated';
        }
        ChatLog::saveNotification($this->notification, $this->project_id);
        \Ratchet\Client\connect('ws://localhost:8080')->then(function($conn) {
            $conn->send($this->notification);
            $conn->close();
        }, function ($e) {
            echo "Could not connect: {$e->getMessage()}\n";
        });
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status_id', 'priority_id'], 'required'],
            [['author_id', 'reporter_id', 'project_id', 'status_id', 'priority_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => Priority::className(), 'targetAttribute' => ['priority_id' => 'id']],
            [['reporter_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['reporter_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'author_id' => 'Author ID',
            'reporter_id' => 'Reporter ID',
            'project_id' => 'Project ID',
            'status_id' => 'Status ID',
            'priority_id' => 'Priority ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::className(), ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReporter()
    {
        return $this->hasOne(User::className(), ['id' => 'reporter_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskTags()
    {
        return $this->hasMany(TaskTag::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['task/view', 'id' => $this->id], true),
            'author' => Url::to(['user/view', 'id' => $this->author_id], true),
            'reporter' => Url::to(['user/view', 'id' => $this->reporter_id], true),
            'project' => Url::to(['project/view', 'id' => $this->project_id], true),
        ];
    }

    public function fields()
    {
        $parentFields = parent::fields();
        $modelFields = [
            'created_at' => function() {
                return Yii::$app->formatter->asDatetime($this->created_at);
            },
            'updated_at' => function() {
                return Yii::$app->formatter->asDatetime($this->created_at);
            }
        ];
        return array_merge($parentFields, $modelFields);
    }
}
