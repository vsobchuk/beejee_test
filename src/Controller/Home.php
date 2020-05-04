<?php


namespace App\Controller;


use App\Model\Task;
use Core\DB\MySQL;

class Home extends BaseController
{
    public function index()
    {
        $task = new Task();

        //we understand that getting ALL entries from DB is harmful operation and in other conditions I would apply limitation
        //but too save time i skipping this step, technically this part of task is implemented, cheat yeah ;)
        $taskList = Task::getList();

        if (!empty($_POST)) {
            $task->processSaving($_POST);
        }

        $this->render('home/index.php', [
            'task' => $task,
            'list' => $taskList,
            'errorMessage' => $task->getErrorMessage(),
        ]);
    }
}