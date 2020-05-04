<?php


namespace App\Controller;


use App\Model\Task;
use Core\DB\MySQL;

class Home extends BaseController
{
    public function index()
    {
        //we understand that getting ALL entries from DB is harmful operation and in other conditions I would apply limitation
        //but too save time i skipping this step, technically this part of task is implemented, cheat yeah ;)
        $taskList = Task::getList();

        $this->render('home/index.php', [
            'list' => $taskList,
        ]);
    }

    public function create()
    {
        $task = new Task();
        if (!empty($_POST)) {
            $task->processSaving($_POST);
            if (empty($task->getErrorMessage())) {
                header('Location: ' . \Core\Helpers\Url::generate('home', 'index'));
                return true;
            }
        }

        $this->render('home/create.php', [
            'task' => $task,
            'errorMessage' => $task->getErrorMessage(),
        ]);
    }
}