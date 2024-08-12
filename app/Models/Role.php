<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public static function getCandidateId(): int
    {
        return Role::firstWhere('role_name', 'candidate')->id;
    }

    public static function getAdminId(): int
    {
        return Role::firstWhere('role_name', 'admin')->id;
    }

}
