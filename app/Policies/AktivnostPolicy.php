<?php

namespace App\Policies;

use App\Models\Aktivnost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AktivnostPolicy
{
    public function view(User $user, Aktivnost $aktivnost): bool
    {
        return $user->id === $aktivnost->user_id || $user->role==='admin';
    }
    public function create(User $user): bool
    {
        return true;
    }
    public function update(User $user, Aktivnost $aktivnost): bool
    {
        return $user->id === $aktivnost->user_id;
    }
    public function delete(User $user, Aktivnost $aktivnost): bool
    {
        return $user->id === $aktivnost->user_id;
    }
    public function restore(User $user, Aktivnost $aktivnost): bool
    {
        return false;
    }

}
