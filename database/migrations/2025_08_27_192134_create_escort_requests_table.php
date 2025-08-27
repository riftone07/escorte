<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('escort_requests', function (Blueprint $table) {
            $table->id();
            $table->string('numero_demande')->unique();
            
            // Informations du demandeur
            $table->string('prenom');
            $table->string('nom');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->text('adresse');
            $table->string('organisme');
            $table->string('fonction');
            
            // Détails de la mission
            $table->string('type_escorte');
            $table->string('urgence');
            $table->datetime('date_mission');
            $table->string('duree_estimee')->nullable();
            $table->text('lieu_depart');
            $table->text('lieu_arrivee');
            $table->longText('description');
            $table->string('numero_dossier')->nullable();
            
            // Personne à contacter
            $table->string('contact_nom');
            $table->string('contact_telephone');
            $table->string('contact_email')->nullable();
            $table->string('contact_fonction')->nullable();
            
            // Documents et statut
            $table->string('document_path')->nullable();
            $table->string('statut')->default('en_attente');
            $table->text('commentaire_admin')->nullable();
            $table->timestamp('date_traitement')->nullable();
            
            $table->timestamps();
            
            // Index pour optimiser les recherches
            $table->index(['statut', 'created_at']);
            $table->index(['urgence', 'date_mission']);
            $table->index('numero_demande');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escort_requests');
    }
};
