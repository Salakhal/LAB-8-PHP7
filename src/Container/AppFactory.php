<?php

namespace App\Container;

use App\Dao\AdminDao;
use App\Security\Auth;
use App\Security\Csrf;
use App\Security\Middleware;
use App\Controller\AuthController;

use App\Core\Request;
use App\Core\Response;
use App\Core\Router;
use App\Core\View;
use App\Controller\EtudiantController;
use App\Dao\DBConnection;
use App\Dao\Logger;
use App\Dao\EtudiantDao;
use App\Dao\FiliereDao;

class AppFactory
{
    public function create(): array
    {
        // Config DB (adapter selon environnement)
        $dbHost = '127.0.0.1';
        $dbName = 'gestion_etudiants_pdo';
        $dbUser = 'root';
        $dbPass = '';
        $charset = 'utf8mb4';

        $logger = new Logger(__DIR__ . '/../../logs/app.log');
        $pdo = DBConnection::create($dbHost, $dbName, $dbUser, $dbPass, $charset, $logger);

        $etudiantDao = new EtudiantDao($pdo, $logger);
        $filiereDao = new FiliereDao($pdo, $logger);

        $view = new View(__DIR__ . '/../../views');
        $response = new Response();
        $request = new Request();
        $router = new Router();

        // --- SÉCURITÉ ET AUTHENTIFICATION ---
        $adminDao = new AdminDao($pdo, $logger);
        $auth = new Auth($adminDao);
        
        // IMPORTANT : Démarrer la session hna !
        $auth->startSession(); 
        
        $csrf = new Csrf();
        $middleware = new Middleware($auth, $response);
        
        // --- CRÉATION DES CONTRÔLEURS ---
        $authController = new AuthController($view, $response, $request, $auth, $csrf);
        
        $etudiantController = new EtudiantController($view, $response, $etudiantDao, $filiereDao, $middleware);

        // --- ROUTES D'AUTHENTIFICATION ---
        $router->get('/login', [$authController, 'showLogin']);
        $router->post('/login', [$authController, 'login']);
        $router->post('/logout', [$authController, 'logout']);

        // --- ROUTES EXIGÉES (Étudiants) ---
        $router->get('/', function() use ($response) { $response->redirect('/etudiants'); });
        $router->get('/etudiants', [$etudiantController, 'index']);
        $router->get('/etudiants/create', [$etudiantController, 'create']);
        $router->post('/etudiants/store', [$etudiantController, 'store']);
        $router->get('/etudiants/{id}', [$etudiantController, 'show']);
        $router->get('/etudiants/{id}/edit', [$etudiantController, 'edit']);
        $router->post('/etudiants/{id}/update', [$etudiantController, 'update']);
        $router->post('/etudiants/{id}/delete', [$etudiantController, 'delete']);
        
        // Optionnel API JSON
        $router->get('/api/etudiants', [$etudiantController, 'apiList']);

        return [$router, $request];
    }
}