<?php

namespace App\Policies;

use App\Models\QrTag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QrTagPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, QrTag $qrTag): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, QrTag $qrTag): bool
    {
        return true;
    }

    public function delete(User $user, QrTag $qrTag): bool
    {
        return true;
    }

    public function restore(User $user, QrTag $qrTag): bool
    {
        return true;
    }

    public function forceDelete(User $user, QrTag $qrTag): bool
    {
        return true;
    }
}
