<?php
// src/Controller/BaseController.php
namespace App\Controller;

use App\Core\Response;
use App\Core\View;

class BaseController
{
    protected $view;
    protected $response;

    public function __construct(View $view, Response $response)
    {
        $this->view = $view;
        $this->response = $response;
    }

    protected function render(string $view, array $params = []): void
    { $this->view->render($view, $params); }

    protected function redirect(string $url, int $status = 302): void
    { $this->response->redirect($url, $status); }

    protected function json($data, int $status = 200): void
    { $this->response->json($data, $status); }

    protected function e(?string $s): string
    { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
}