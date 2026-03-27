<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'email', 'password', 'role', 'is_approved'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Define who the Super Admin is.
     */
    public function isSuperAdmin()
    {
        // This ensures only Mangesh's email gets Admin powers
        return $this->email === 'pandit.mangesh002@gmail.com';
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_approved' => 'boolean', // Ensures 0/1 is treated as true/false
        ];
    }
}