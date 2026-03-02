<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject; // ini untuk implement JWT
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable; 
    // ini tidak pakai HasApiTokens lagi karena kita sudah pakai JWT

    /**
     * Kolom yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role' // ini ditambahkan untuk role admin/user
    ];

    /**
     * Kolom yang disembunyikan saat return JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting otomatis
     */
    protected $casts = [
        'password' => 'hashed', // ini otomatis hash password Laravel 10
    ];

    /**
     * Mengembalikan ID yang akan disimpan di dalam token JWT
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); 
        // ini mengambil primary key user (id)
    }

    /**
     * Custom claims tambahan untuk JWT (kalau mau tambahin role dll)
     */
    public function getJWTCustomClaims()
    {
        return []; 
        // ini bisa diisi kalau mau tambahin data custom di dalam token
    }
}