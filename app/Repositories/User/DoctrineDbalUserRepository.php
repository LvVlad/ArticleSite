<?php declare(strict_types=1);

namespace app\Repositories\User;

use App\Models\User;

class DoctrineDbalUserRepository implements UserRepository
{
    public function show(int $id): ?User
    {
        // TODO: Implement show() method.
    }
}