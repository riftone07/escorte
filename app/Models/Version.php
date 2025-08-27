<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Version extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'numero_appstore',
        'numero_playstore',
        'url_appstore',
        'url_playstore',
        'motif_appstore',
        'motif_playstore',
        'titre_appstore',
        'titre_playstore',
        'obligatoire_appstore',
        'obligatoire_playstore',
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'obligatoire_appstore' => 'boolean',
        'obligatoire_playstore' => 'boolean',
    ];

    /**
     * Récupère la version active (la plus récente)
     *
     * @return Version|null
     */
    public static function getActive()
    {
        return self::latest()->first();
    }
}
