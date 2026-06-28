<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    protected $fillable = [
        'role_user_id',
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function roleUser(): BelongsTo
    {
        return $this->belongsTo(RoleUser::class);
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::needsRehash($value) ? Hash::make($value) : $value,
        );
    }
}
