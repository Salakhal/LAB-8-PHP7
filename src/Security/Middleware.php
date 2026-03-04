<?php

namespace App\Security;

use App\Core\Response;

class Middleware
{
    private $auth;
    private $response;

    public function __construct(Auth $auth, Response $response)
    {
        $this->auth = $auth;
        $this->response = $response;
    }

    public function requireAdmin(): void
    {
        if (!$this->auth->isAuthenticated()) {
            $this->response->redirect('/login');
            exit;
        }
    }
}