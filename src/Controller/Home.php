<?php


namespace App\Controller;


use App\Model\Task;
use Core\DB\MySQL;

class Home extends BaseController
{
    public function index()
    {
        $task = new Task();
        $taskList = Task::getList(Task::DEFAULT_PAGE_SIZE);

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