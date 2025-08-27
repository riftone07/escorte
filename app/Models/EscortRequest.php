<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class EscortRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_demande',
        'prenom',
        'nom',
        'telephone',
        'email',
        'adresse',
        'organisme',
        'fonction',
        'type_escorte',
        'urgence',
        'date_mission',
        'duree_estimee',
        'lieu_depart',
        'lieu_arrivee',
        'description',
        'numero_dossier',
        'contact_nom',
        'contact_telephone',
        'contact_email',
        'contact_fonction',
        'document_path',
        'statut',
        'commentaire_admin',
        'date_traitement',
    ];

    protected $casts = [
        'date_mission' => 'datetime',
        'date_traitement' => 'datetime',
    ];

    // Accessor pour le nom complet
    protected function nomComplet(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->prenom . ' ' . $this->nom,
        );
    }

    // Accessor pour le nom complet du contact
    protected function contactNomComplet(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->contact_nom,
        );
    }

    // Scope pour filtrer par statut
    public function scopeParStatut($query, $statut)
    {
        return $query->where('statut', $statut);
    }

    // Scope pour filtrer par urgence
    public function scopeParUrgence($query, $urgence)
    {
        return $query->where('urgence', $urgence);
    }

    // Scope pour les demandes récentes
    public function scopeRecentes($query, $jours = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($jours));
    }

    // Méthode pour générer un numéro de demande unique
    public static function genererNumeroDemande()
    {
        do {
            $numero = 'ESC-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('numero_demande', $numero)->exists());
        
        return $numero;
    }

    // Méthode pour obtenir le libellé du statut
    public function getStatutLibelleAttribute()
    {
        $statuts = [
            'en_attente' => 'En attente',
            'en_cours' => 'En cours de traitement',
            'approuve' => 'Approuvé',
            'refuse' => 'Refusé',
            'termine' => 'Terminé'
        ];

        return $statuts[$this->statut] ?? $this->statut;
    }

    // Méthode pour obtenir le libellé de l'urgence
    public function getUrgenceLibelleAttribute()
    {
        $urgences = [
            'normale' => 'Normale (72h)',
            'urgent' => 'Urgent (24h)',
            'tres_urgent' => 'Très urgent (immédiat)'
        ];

        return $urgences[$this->urgence] ?? $this->urgence;
    }

    // Méthode pour obtenir le libellé du type d'escorte
    public function getTypeEscorteLibelleAttribute()
    {
        $types = [
            'transport_fonds' => 'Transport de fonds',
            'personnalites' => 'Personnalités/VIP',
            'marchandises' => 'Marchandises précieuses',
            'convoi_special' => 'Convoi spécial',
            'autre' => 'Autre'
        ];

        return $types[$this->type_escorte] ?? $this->type_escorte;
    }
}
