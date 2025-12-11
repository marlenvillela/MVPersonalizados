<?php
namespace App\Core;

class Controller {
    protected function render($template, $data = []) {
        extract($data);
        $viewFile = __DIR__ . '/../Views/templates/' . $template . '.tpl';
        if (!file_exists($viewFile)) {
            echo 'View not found: ' . $viewFile;
            return;
        }
        include __DIR__ . '/../Views/templates/layouts/header.tpl';
        include $viewFile;
        include __DIR__ . '/../Views/templates/layouts/footer.tpl';
    }
}
