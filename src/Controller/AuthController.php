<?php
namespace App\Controller;

use App\Core\View;
use App\Core\Response;
use App\Core\Request;
use App\Security\Auth;
use App\Security\Csrf;

class AuthController extends BaseController
{
    private $request;
    private $auth;
    private $csrf;

    public function __construct(View $view, Response $response, Request $request, Auth $auth, Csrf $csrf) {
    parent::__construct($view, $response);
    $this->request = $request;
    $this->auth = $auth;
    $this->csrf = $csrf;
}
    public function showLogin(): void
    {
        $this->render('auth/login.php', [
            'csrf_token' => $this->csrf->token()
        ]);
    }

    public function login(): void
    {
        $username = $this->request->getBodyParam('username') ?? '';
        $password = $this->request->getBodyParam('password') ?? '';
        $token = $this->request->getBodyParam('csrf_token') ?? '';

        if (!$this->csrf->verify($token)) {
            $this->render('auth/login.php', ['erreur' => 'Erreur de sécurité (CSRF).', 'csrf_token' => $this->csrf->token()]);
            return;
        }

        if ($this->auth->login($username, $password)) {
            $this->response->redirect('/etudiants');
        } else {
            $this->render('auth/login.php', ['erreur' => 'Nom d\'utilisateur ou mot de passe incorrect.', 'csrf_token' => $this->csrf->token()]);
        }
    }

    public function logout(): void
{
    session_destroy();
    $_SESSION = [];
    
    $this->response->redirect('/login');
}
}