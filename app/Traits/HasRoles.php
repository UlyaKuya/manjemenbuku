<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(string $role): bool
    {
        return $this->roles->contains('name', $role);
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->roles
            ->whereIn('name', $roles)
            ->isNotEmpty();
    }

    public function assignRole(string|Role $role): void
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching($role->id);

        $this->unsetRelation('roles');
    }

    public function removeRole(string $role): void
    {
        $role = Role::where('name', $role)->first();

        if ($role) {
            $this->roles()->detach($role->id);
            $this->unsetRelation('roles');
        }
    }
}