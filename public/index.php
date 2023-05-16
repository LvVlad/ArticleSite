<?php declare(strict_types=1);

require_once '../vendor/autoload.php';

use App\Core\Renderer;
use App\Core\Router;

$response = Router::response();
$renderer = new Renderer();

echo $renderer->render($response);