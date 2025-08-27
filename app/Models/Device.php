<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'token',
        'device_id',
        'device_type',
        'device_name',
        'app_version',
        'last_active_at',
        'is_active',
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_active_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Obtenir l'utilisateur propriétaire de ce device.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
