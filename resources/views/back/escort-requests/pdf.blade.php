<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande d'Escorte - {{ $escortRequest->numero_demande }}</title>
    <style>
        @page {
            margin: 2cm;
            size: A4;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #1e3a8a;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .logo {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }
        
        .header h1 {
            color: #1e3a8a;
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
            text-transform: uppercase;
        }
        
        .header h2 {
            color: #666;
            font-size: 16px;
            font-weight: normal;
            margin: 5px 0;
        }
        
        .document-info {
            text-align: right;
            margin-bottom: 30px;
            font-size: 11px;
            color: #666;
        }
        
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section-title {
            background-color: #1e3a8a;
            color: white;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        
        .field-group {
            margin-bottom: 15px;
        }
        
        .field {
            margin-bottom: 8px;
            overflow: hidden;
        }
        
        .field-label {
            font-weight: bold;
            width: 35%;
            float: left;
            padding: 4px 0;
        }
        
        .field-value {
            margin-left: 35%;
            padding: 4px 0 4px 15px;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .badge-warning {
            background-color: #fbbf24;
            color: #92400e;
        }
        
        .badge-danger {
            background-color: #f87171;
            color: #991b1b;
        }
        
        .badge-success {
            background-color: #34d399;
            color: #065f46;
        }
        
        .badge-info {
            background-color: #60a5fa;
            color: #1e40af;
        }
        
        .badge-secondary {
            background-color: #9ca3af;
            color: #374151;
        }
        
        .description-box {
            border: 1px solid #d1d5db;
            padding: 12px;
            background-color: #f9fafb;
            margin-top: 5px;
            border-radius: 4px;
        }
        
        .footer {
            position: fixed;
            bottom: 1cm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
        
        .signature-section {
            margin-top: 40px;
            overflow: hidden;
        }
        
        .signature-box {
            width: 45%;
            float: left;
            text-align: center;
            border: 1px solid #d1d5db;
            padding: 20px;
            margin-right: 10%;
        }
        
        .signature-box:last-child {
            margin-right: 0;
        }
        
        .signature-title {
            font-weight: bold;
            margin-bottom: 40px;
        }
        
        .signature-line {
            border-bottom: 1px solid #333;
            margin-bottom: 5px;
            height: 40px;
        }
        
        .two-columns {
            overflow: hidden;
        }
        
        .column {
            width: 48%;
            float: left;
        }
        
        .column:first-child {
            margin-right: 4%;
        }
        
        .status-info {
            background-color: #f3f4f6;
            border-left: 4px solid #1e3a8a;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <!-- En-tête officiel -->
    <div class="header">
        <img src="{{ public_path('images/logogendarmerie.jpg') }}" alt="Logo Gendarmerie" class="logo">
        <h1>République Française</h1>
        <h2>Gendarmerie Nationale</h2>
        <h2>Demande d'Escorte Officielle</h2>
    </div>
    
    <!-- Informations du document -->
    <div class="document-info">
        <strong>Numéro de demande :</strong> {{ $escortRequest->numero_demande }}<br>
        <strong>Date de création :</strong> {{ $escortRequest->created_at->format('d/m/Y à H:i') }}<br>
        @if($escortRequest->date_traitement)
        <strong>Date de traitement :</strong> {{ $escortRequest->date_traitement->format('d/m/Y à H:i') }}<br>
        @endif
    </div>

    <!-- Statut de la demande -->
    <div class="status-info">
        <strong>Statut actuel :</strong> 
        @if($escortRequest->statut === 'en_attente')
            <span class="badge badge-warning">{{ $escortRequest->statut_libelle }}</span>
        @elseif($escortRequest->statut === 'en_cours')
            <span class="badge badge-info">{{ $escortRequest->statut_libelle }}</span>
        @elseif($escortRequest->statut === 'approuve')
            <span class="badge badge-success">{{ $escortRequest->statut_libelle }}</span>
        @elseif($escortRequest->statut === 'refuse')
            <span class="badge badge-danger">{{ $escortRequest->statut_libelle }}</span>
        @else
            <span class="badge badge-secondary">{{ $escortRequest->statut_libelle }}</span>
        @endif
    </div>
    
    <!-- Informations du demandeur -->
    <div class="section">
        <div class="section-title">Informations du Demandeur</div>
        <div class="field-group">
            <div class="field">
                <div class="field-label">Nom complet :</div>
                <div class="field-value">{{ $escortRequest->nom_complet }}</div>
            </div>
            <div class="field">
                <div class="field-label">Téléphone :</div>
                <div class="field-value">{{ $escortRequest->telephone }}</div>
            </div>
            <div class="field">
                <div class="field-label">Email :</div>
                <div class="field-value">{{ $escortRequest->email }}</div>
            </div>
            <div class="field">
                <div class="field-label">Organisme :</div>
                <div class="field-value">{{ $escortRequest->organisme }}</div>
            </div>
            <div class="field">
                <div class="field-label">Fonction :</div>
                <div class="field-value">{{ $escortRequest->fonction }}</div>
            </div>
            @if($escortRequest->adresse)
            <div class="field">
                <div class="field-label">Adresse :</div>
                <div class="field-value">{{ $escortRequest->adresse }}</div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Détails de la mission -->
    <div class="section">
        <div class="section-title">Détails de la Mission</div>
        
        <!-- Informations générales -->
        <div class="field-group">
            <div class="field">
                <div class="field-label">Type d'escorte :</div>
                <div class="field-value">
                    <span class="badge badge-info">{{ $escortRequest->type_escorte_libelle }}</span>
                </div>
            </div>
            <div class="field">
                <div class="field-label">Niveau d'urgence :</div>
                <div class="field-value">
                    @if($escortRequest->urgence === 'tres_urgent')
                        <span class="badge badge-danger">{{ $escortRequest->urgence_libelle }}</span>
                    @elseif($escortRequest->urgence === 'urgent')
                        <span class="badge badge-warning">{{ $escortRequest->urgence_libelle }}</span>
                    @else
                        <span class="badge badge-success">{{ $escortRequest->urgence_libelle }}</span>
                    @endif
                </div>
            </div>
            @if($escortRequest->numero_dossier)
            <div class="field">
                <div class="field-label">Numéro de dossier :</div>
                <div class="field-value">{{ $escortRequest->numero_dossier }}</div>
            </div>
            @endif
        </div>

        <!-- Planification -->
        <div style="background-color: #f8fafc; padding: 15px; margin: 15px 0; border-left: 4px solid #3b82f6;">
            <h4 style="margin: 0 0 10px 0; color: #1e40af; font-size: 14px;">📅 PLANIFICATION</h4>
            <div class="field-group">
                <div class="field">
                    <div class="field-label">Date et heure de mission :</div>
                    <div class="field-value"><strong>{{ $escortRequest->date_mission->format('d/m/Y à H:i') }}</strong></div>
                </div>
                @if($escortRequest->duree_estimee)
                <div class="field">
                    <div class="field-label">Durée estimée :</div>
                    <div class="field-value">{{ $escortRequest->duree_estimee }} heures</div>
                </div>
                @endif
                <div class="field">
                    <div class="field-label">Nombre de personnes à escorter :</div>
                    <div class="field-value"><strong>{{ $escortRequest->nombre_personnes }}</strong></div>
                </div>
            </div>
        </div>

        <!-- Itinéraire -->
        <div style="background-color: #f0fdf4; padding: 15px; margin: 15px 0; border-left: 4px solid #22c55e;">
            <h4 style="margin: 0 0 10px 0; color: #15803d; font-size: 14px;">🗺️ ITINÉRAIRE</h4>
            <div class="field-group">
                <div class="field">
                    <div class="field-label">Point de départ :</div>
                    <div class="field-value"><strong>{{ $escortRequest->lieu_depart }}</strong></div>
                </div>
                <div class="field">
                    <div class="field-label">Point d'arrivée :</div>
                    <div class="field-value"><strong>{{ $escortRequest->lieu_arrivee }}</strong></div>
                </div>
            </div>
        </div>

        <!-- Description détaillée -->
        <div style="background-color: #fffbeb; padding: 15px; margin: 15px 0; border-left: 4px solid #f59e0b;">
            <h4 style="margin: 0 0 10px 0; color: #d97706; font-size: 14px;">📋 DESCRIPTION DE LA MISSION</h4>
            <div class="description-box" style="background-color: white; border: 1px solid #e5e7eb;">
                {{ $escortRequest->description }}
            </div>
        </div>
    </div>
    
    <!-- Personne à contacter -->
    @if($escortRequest->contact_nom)
    <div class="section">
        <div class="section-title">Personne à Contacter</div>
        <div class="field-group">
            <div class="field">
                <div class="field-label">Nom :</div>
                <div class="field-value">{{ $escortRequest->contact_nom }}</div>
            </div>
            <div class="field">
                <div class="field-label">Téléphone :</div>
                <div class="field-value">{{ $escortRequest->contact_telephone }}</div>
            </div>
            @if($escortRequest->contact_email)
            <div class="field">
                <div class="field-label">Email :</div>
                <div class="field-value">{{ $escortRequest->contact_email }}</div>
            </div>
            @endif
            @if($escortRequest->contact_fonction)
            <div class="field">
                <div class="field-label">Fonction :</div>
                <div class="field-value">{{ $escortRequest->contact_fonction }}</div>
            </div>
            @endif
        </div>
    </div>
    @endif
    
    <!-- Commentaires administratifs -->
    @if($escortRequest->commentaire_admin)
    <div class="section">
        <div class="section-title">Commentaires Administratifs</div>
        <div class="description-box">
            {{ $escortRequest->commentaire_admin }}
        </div>
    </div>
    @endif
    
    <!-- Section signatures -->
    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-title">Demandeur</div>
            <div class="signature-line"></div>
            <div>Signature et cachet</div>
        </div>
        <div class="signature-box">
            <div class="signature-title">Autorité Compétente</div>
            <div class="signature-line"></div>
            <div>Signature et cachet</div>
        </div>
    </div>
    
    <!-- Pied de page -->
    <div class="footer">
        Document généré le {{ now()->format('d/m/Y à H:i') }} - Demande {{ $escortRequest->numero_demande }}<br>
        Gendarmerie Nationale - Service des Escortes Officielles
    </div>
</body>
</html>
