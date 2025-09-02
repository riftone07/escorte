<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EscortRequest;
use Illuminate\Http\Request;
use App\Traits\WithBreadcrumb;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class EscortRequestController extends Controller
{
    use WithBreadcrumb;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EscortRequest::query();

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('urgence')) {
            $query->where('urgence', $request->urgence);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('numero_demande', 'like', "%{$search}%")
                  ->orWhere('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('organisme', 'like', "%{$search}%");
            });
        }

        $escortRequests = $query->orderBy('created_at', 'desc')->paginate(15);

        $data = $this->withBreadcrumb([
            'Demandes d\'escorte' => route('admin.escort-requests.index')
        ], [
            'escortRequests' => $escortRequests,
            'filters' => $request->only(['statut', 'urgence', 'search'])
        ]);

        return view('back.escort-requests.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->withBreadcrumb([
            'Demandes d\'escorte' => route('admin.escort-requests.index'),
            'Nouvelle demande' => '#'
        ], []);

        return view('back.escort-requests.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'adresse' => 'nullable|string|max:500',
            'organisme' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'type_escorte' => 'required|in:personnalite,transport_fonds,transport_detenus,mission_speciale',
            'urgence' => 'required|in:normale,urgent,tres_urgent',
            'date_mission' => 'required|date|after:now',
            'duree_estimee' => 'nullable|numeric|min:0.5|max:24',
            'nombre_personnes' => 'required|integer|min:1|max:50',
            'lieu_depart' => 'required|string|max:500',
            'lieu_arrivee' => 'required|string|max:500',
            'description' => 'required|string',
            'contact_nom' => 'nullable|string|max:255',
            'contact_telephone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'contact_fonction' => 'nullable|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'statut' => 'nullable|in:en_attente,en_cours,approuve,refuse,termine',
            'commentaire_admin' => 'nullable|string'
        ]);

        // Générer un numéro de demande unique
        $validated['numero_demande'] = EscortRequest::generateUniqueRequestNumber();

        // Gérer l'upload du document
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $validated['document_path'] = $file->storeAs('escort-requests', $filename, 'public');
        }

        // Définir le statut par défaut
        if (!isset($validated['statut'])) {
            $validated['statut'] = 'en_attente';
        }

        $escortRequest = EscortRequest::create($validated);

        return redirect()->route('admin.escort-requests.show', $escortRequest)
            ->with('success', 'Demande d\'escorte créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(EscortRequest $escortRequest)
    {
        $data = $this->withBreadcrumb([
            'Demandes d\'escorte' => route('admin.escort-requests.index'),
            'Demande #' . $escortRequest->numero_demande => '#'
        ], [
            'escortRequest' => $escortRequest
        ]);

        return view('back.escort-requests.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EscortRequest $escortRequest)
    {
        $data = $this->withBreadcrumb([
            'Demandes d\'escorte' => route('admin.escort-requests.index'),
            'Demande #' . $escortRequest->numero_demande => route('admin.escort-requests.show', $escortRequest),
            'Modifier' => '#'
        ], [
            'escortRequest' => $escortRequest
        ]);

        return view('back.escort-requests.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EscortRequest $escortRequest)
    {
        $validated = $request->validate([
            'statut' => 'required|in:en_attente,en_cours,approuve,refuse,termine',
            'commentaire_admin' => 'nullable|string',
            'date_traitement' => 'nullable|date'
        ]);

        // Si le statut change, mettre à jour la date de traitement
        if ($escortRequest->statut !== $validated['statut']) {
            $validated['date_traitement'] = now();
        }

        $escortRequest->update($validated);

        return redirect()->route('admin.escort-requests.show', $escortRequest)
            ->with('success', 'Demande mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EscortRequest $escortRequest)
    {
        // Supprimer le document associé s'il existe
        if ($escortRequest->document_path) {
            Storage::disk('public')->delete($escortRequest->document_path);
        }

        $escortRequest->delete();

        return redirect()->route('admin.escort-requests.index')
            ->with('success', 'Demande supprimée avec succès');
    }

    /**
     * Télécharger le document associé à la demande
     */
    public function downloadDocument(EscortRequest $escortRequest)
    {
        if (!$escortRequest->document_path || !Storage::disk('public')->exists($escortRequest->document_path)) {
            abort(404, 'Document non trouvé');
        }

        return response()->download(storage_path('app/public/' . $escortRequest->document_path));
    }

    /**
     * Changer rapidement le statut d'une demande
     */
    public function updateStatus(Request $request, EscortRequest $escortRequest)
    {
        $validated = $request->validate([
            'statut' => 'required|in:en_attente,en_cours,approuve,refuse,termine'
        ]);

        $escortRequest->update([
            'statut' => $validated['statut'],
            'date_traitement' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour avec succès',
            'statut' => $escortRequest->statut_libelle
        ]);
    }

    /**
     * Générer un PDF de la demande d'escorte
     */
    public function generatePdf(EscortRequest $escortRequest)
    {
        $pdf = Pdf::loadView('back.escort-requests.pdf', compact('escortRequest'));
        
        $filename = 'demande_escorte_' . $escortRequest->numero_demande . '.pdf';
        
        return $pdf->download($filename);
    }
}
