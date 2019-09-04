<?php


namespace frontend\controllers;


use yii\web\Controller;

class TaskController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView()
    {
        $task = [];
        $task['name'] = 'Test task';
        $task['description'] = 'Test desc';
        $task['author'] = 'Test user';
        $task['reporter'] = 'Another test user';
        $task['status'] = 'created';
        $task['tags'] = [
            'design', 'backend',
        ];
        $task['priority'] = 'high';
        $comments = [];
        $comments[] = '1st comment';
        $comments[] = '2nd comment';
        $comments[] = '3rd comment';
        return $this->render('view', [
            'task' => $task,
            'comments' => $comments,
        ]);
    }
}