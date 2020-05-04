<?php


namespace Core;


class RequestHandler
{
    protected static $instance;

    protected $defaultControllerNamespace = '\\App\\Controller\\';
    protected $defaultControllerName = 'Home';
    protected $defaultAction = 'index';

    public static function getInstance(): RequestHandler
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getRequestedControllerName(): string
    {
        return $this->defaultControllerNamespace . (ucfirst($_GET['c'] ?? $this->defaultControllerName));
    }

    public function getRequestedControllerAction()
    {
        $action = $_GET['a'] ?? $this->defaultAction;
        return $action;
    }

    public function run()
    {
        $controller = $this->getRequestedControllerName();
        $action = $this->getRequestedControllerAction();
        $controller = new $controller;
        $controller->$action();
    }
}