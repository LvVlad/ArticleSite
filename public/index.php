<?php declare(strict_types=1);

require_once '../vendor/autoload.php';

use App\Core\Redirect\Redirect;
use App\Core\Renderer;
use App\Core\Router;
use App\Core\View;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');


$response = Router::response(require_once '../routes.php');

if($response instanceof View)
{
    $renderer = new Renderer();
    echo $renderer->render($response);
} elseif($response instanceof Redirect)
{
    header('Location: '.$response->getPath());
}