<?php
declare(strict_types=1);

use App\Container\AppFactory;
use App\Core\Request;

// Autoloader simple PSR-4 minimal (si pas de Composer)
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = dirname(__DIR__) . '/src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative = str_replace('\\', '/', substr($class, $len));
    $file = $baseDir . $relative . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Rediriger / vers /etudiants
if (isset($_SERVER['REQUEST_URI']) && rtrim($_SERVER['REQUEST_URI'], '/') === '') {
    header('Location: /etudiants');
    exit;
}

// Boot
$factory = new AppFactory();
[$router, $request] = $factory->create();

// Dispatch
$router->dispatch($request);