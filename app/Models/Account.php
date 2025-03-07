<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    // Một loại tài khoản có nhiều người dùng
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
