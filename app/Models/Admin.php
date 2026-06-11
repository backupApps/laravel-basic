<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    protected $fillable = [
        'role_user_id',
        'nama',
    ];

    public function roleUser(): BelongsTo
    {
        return $this->belongsTo(RoleUser::class);
    }
}
