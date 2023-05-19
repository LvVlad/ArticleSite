<?php

use App\Commands\IndexArticleCommand;
use App\Commands\ShowArticleCommand;
use App\Commands\ShowUserCommand;

require_once 'vendor/autoload.php';

$command = $argv[1] ?? null;
$id = $argv[2] ?? null;

switch ($command)
{
    case 'help';
        echo "Type:
        *'article' without id to index all articles\n
        *'article id' where id is digit to show article\n
        *'user id' where id is digit to show user";
        break;
    case 'article';
        if($id != null)
        {
            $response = new ShowArticleCommand();
            $response->execute($id);
            break;
        }
        $response = new IndexArticleCommand();
        $response->execute();
        break;
    case 'user';
        $response = new ShowUserCommand();
        $response->execute($id);
        break;
    default:
        echo "Type 'php console.log help' to get all commands";
        break;
}