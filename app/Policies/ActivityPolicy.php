<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Activitylog\Models\Activity;

class ActivityPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    public function view(User $user, Activity $activity): bool
    {
        return $user->is_admin;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Activity $activity): bool
    {
        return $user->is_admin;
    }

    public function delete(User $user, Activity $activity): bool
    {
        return $user->is_admin;
    }

    public function restore(User $user, Activity $activity): bool
    {
        return $user->is_admin;
    }

    public function forceDelete(User $user, Activity $activity): bool
    {
        return $user->is_admin;
    }
}
