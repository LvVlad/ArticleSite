<?php declare(strict_types=1);

namespace App\Services\User\Show;

use App\Repositories\User\UserRepository;

class ShowUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(ShowUserRequest $request): ShowUserResponse
    {
        $user = $this->userRepository->show($request->getUserId());
        return new ShowUserResponse($user);
    }
}