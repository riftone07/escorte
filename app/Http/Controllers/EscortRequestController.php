<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\EscortRequest;

class EscortRequestController extends Controller
{
    /**
     * Show the form for creating a new escort request.
     */
    public function create()
    {
        // Mock data for escort types - you can replace this with database data
        $marques = collect([
            (object)['libelle' => 'Transport de fonds'],
            (object)['libelle' => 'Personnalités/VIP'],
            (object)['libelle' => 'Marchandises précieuses'],
            (object)['libelle' => 'Convoi spécial'],
            (object)['libelle' => 'Autre']
        ]);

        return view('front.reclamation', compact('marques'));
    }

    /**
     * Store a newly created escort request.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'adresse' => 'required|string|max:500',
            'type_escorte' => 'required|string',
            'urgence' => 'required|string',
            'date_mission' => 'required|date',
            'duree_estimee' => 'nullable|string|max:255',
            'lieu_depart' => 'required|string|max:500',
            'lieu_arrivee' => 'required|string|max:500',
            'description' => 'required|string',
            'numero_dossier' => 'nullable|string|max:255',
            'organisme' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'contact_nom' => 'required|string|max:255',
            'contact_telephone' => 'required|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'contact_fonction' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:5120', // 5MB max
        ], [
            'prenom.required' => 'Le prénom est obligatoire.',
            'nom.required' => 'Le nom est obligatoire.',
            'telephone.required' => 'Le téléphone est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'type_escorte.required' => 'Le type d\'escorte est obligatoire.',
            'urgence.required' => 'Le niveau d\'urgence est obligatoire.',
            'date_mission.required' => 'La date de mission est obligatoire.',
            'lieu_depart.required' => 'Le lieu de départ est obligatoire.',
            'lieu_arrivee.required' => 'Le lieu d\'arrivée est obligatoire.',
            'description.required' => 'La description de la mission est obligatoire.',
            'organisme.required' => 'L\'organisme est obligatoire.',
            'fonction.required' => 'La fonction est obligatoire.',
            'contact_nom.required' => 'Le nom du contact est obligatoire.',
            'contact_telephone.required' => 'Le téléphone du contact est obligatoire.',
            'contact_email.email' => 'L\'email du contact doit être valide.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'Les formats acceptés sont : JPEG, PNG, JPG, GIF, PDF.',
            'image.max' => 'La taille du fichier ne doit pas dépasser 5 Mo.',
        ]);

        // Handle file upload
        $documentPath = null;
        if ($request->hasFile('image')) {
            $documentPath = $request->file('image')->store('escort-requests', 'public');
        }

        // Generate a unique request number
        $requestNumber = EscortRequest::genererNumeroDemande();

        // Save to database
        $escortRequest = EscortRequest::create(array_merge($validatedData, [
            'numero_demande' => $requestNumber,
            'document_path' => $documentPath,
            'statut' => 'en_attente',
        ]));

        // Send confirmation email (optional - you can implement this later)
        try {
            // Mail::to($validatedData['email'] ?? 'admin@gendarmerie.sn')
            //     ->send(new EscortRequestConfirmation($escortRequest));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Illuminate\Support\Facades\Log::error('Failed to send escort request email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 
            "Votre demande d'escorte a été soumise avec succès. " .
            "Numéro de référence: {$requestNumber}. " .
            "Nos équipes vous contacteront dans les plus brefs délais."
        );
    }
}
