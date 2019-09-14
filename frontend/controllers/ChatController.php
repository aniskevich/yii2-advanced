<?php


namespace frontend\controllers;


use common\models\ChatLog;
use common\models\User;
use yii\web\Controller;

class ChatController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index',
            [
                'username' => \Yii::$app->user->identity->username,
            ]);
    }

    public function actionStory() {
        $messages = ChatLog::find()->all();
        $storyArray = [];
        foreach ($messages as $message) {
            $storyEntry = [
                'id' => $message->id,
                'username' => User::findIdentity($message->user_id)->username,
                'message' => $message->message,
                'date' => \Yii::$app->formatter->asDatetime($message->created_at)
            ];
            $storyArray[] = $storyEntry;
        }
        echo json_encode($storyArray);
    }
}