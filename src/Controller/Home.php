<?php


namespace App\Controller;


class Home extends BaseController
{
    public function index()
    {
        $this->render('home/index.php', ['var' => 'test']);
    }
}