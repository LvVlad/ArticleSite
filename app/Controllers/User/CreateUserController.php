<?php declare(strict_types=1);

namespace App\Controllers\User;

use App\Services\User\Create\CreateUserService;

class CreateUserController
{
    private CreateUserService $createUserService;

    public function __construct(CreateUserService $createUserService)
    {
        $this->createUserService = $createUserService;
    }

    public function register()
    {

    }

    public function store()
    {

    }
}