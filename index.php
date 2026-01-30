<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$route = $_GET['route'] ?? 'login';
$id = $_GET['id'] ?? null;

use App\Controllers\LoginController;
use App\Controllers\HomeController;

switch ($route) {
    // AUTH
    case 'login':
        (new LoginController())->index();
        break;
    case 'auth/login':
        (new LoginController())->login();
        break;
    case 'auth/logout':
        (new LoginController())->logout();
        break;
    // CRUD
    case 'home':
        (new HomeController())->index();
        break;
    case 'actor/create':
        (new HomeController())->create();
        break;
    case 'actor/store':
        (new HomeController())->store();
        break;
    case 'actor/edit':
        (new HomeController())->edit($id);
        break;
    case 'actor/update':
        (new HomeController())->update();
        break;
    case 'actor/delete':
        (new HomeController())->delete($id);
        break;

    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}