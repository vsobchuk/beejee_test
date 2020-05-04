<?php
require __DIR__ .'/vendor/autoload.php';

$app = Core\RequestHandler::getInstance();
$app->run();
