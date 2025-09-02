<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    public const ROLES = [
        'admin' => 'Admin',
        'user' => 'User',
        'notaris' => 'Notaris',
        'petugas_pelayanan' => 'Petugas Pelayanan',
        'kepala_upt' => 'Kepala UPT Pelayanan',
        'kasubit_penataan' => 'Kasubit Penataan dan Penetapan',
        'kabit_pendapatan' => 'Kabit Pendapatan',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'id_ppat'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getRoleLabel(): string
    {
        return self::ROLES[$this->role] ?? 'Tidak Diketahui';
    }
    public function ppat()
{
    return $this->belongsTo(\App\Models\Ppat::class, 'id_ppat', 'id');
}
}
