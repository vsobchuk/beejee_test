<?php


namespace Core\Helpers;


class Url
{
    public static function generate(string $controller, string $action, array $params = []): string
    {
        // Core\Helpers\Url::generate('home', 'text', ['id' => 1])
        $params['c'] = $controller;
        $params['a'] = $action;

        $url = http_build_query($params);
        return $url;
    }
}