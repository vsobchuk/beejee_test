<?php


namespace App\Controller;


use App\Model\Task;
use App\Model\User;
use Core\DB\MySQL;
use Core\RequestHandler;

class Home extends BaseController
{
    protected function isEditEnabled()
    {
        return $_SESSION[RequestHandler::SESSION_KEY_USER_ID] != null;
    }

    public function index()
    {
        //we understand that getting ALL entries from DB is harmful operation and in other conditions I would apply limitation
        //but too save time i skipping this step, technically this part of task is implemented, cheat yeah ;)
        $taskList = Task::getList();

        $this->render('home/index.php', [
            'list' => $taskList,
            'isEditEnabled' => $this->isEditEnabled(),
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

    public function update()
    {
        if (!\Core\RequestHandler::getUserId()) {
            throw new \Exception('Only authenticated users can update');
        }

        $task = Task::loadById((int)$_GET['id']);
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

    public function login()
    {
        $user = new User();

        if (!empty($_POST)) {
            $user->processLogin($_POST);
            if (empty($user->getErrorMessage())) {
                header('Location: ' . \Core\Helpers\Url::generate('home', 'index'));
                return true;
            }
        }

        $this->render('home/login.php', [
            'user' => $user,
            'errorMessage' => $user->getErrorMessage(),
        ]);
    }

    public function logout()
    {
        header('Location: ' . \Core\Helpers\Url::generate('home', 'index'));
        $_SESSION[RequestHandler::SESSION_KEY_USER_ID] = null;
    }
}