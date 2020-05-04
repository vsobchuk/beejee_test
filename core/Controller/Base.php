<?php


namespace Core\Controller;


class Base
{
    public function render(string $path, array $params = [])
    {
        $viewsDir = __DIR__ . '/../../view/';
        // understood that $path can be compromited (../../../../../../etc/passwd) for now we skip checks
        $file = $viewsDir . $path;
        if (!empty($params)) {
            extract($params);
        }
        ob_start();
        require $file;
        $textOfTheView = ob_get_clean();

        require $viewsDir . 'base.php';
    }
}