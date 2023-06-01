<?php declare(strict_types=1);

require_once '../vendor/autoload.php';

use App\Core\Renderer;
use App\Core\Router;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');


$response = Router::response(require_once '../routes.php');
$renderer = new Renderer();

echo $renderer->render($response);