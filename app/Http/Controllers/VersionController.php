<?php

namespace App\Http\Controllers;

use App\Http\Resources\VersionResource;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Traits\WithBreadcrumb;

class VersionController extends Controller
{
    use WithBreadcrumb;

    /**
     * Affiche la version actuelle ou le formulaire de création si aucune version n'existe
     */
    public function index()
    {
        $version = Version::getActive();

        if ($version) {
            // Si une version existe, afficher ses détails
            $data = $this->withBreadcrumb([
                'Versions' => route('admin.versions.index')
            ], [
                'version' => $version
            ]);

            return view('back.versions.show', $data);
        } else {
            // Si aucune version n'existe, rediriger vers le formulaire de création
            return redirect()->route('admin.versions.create');
        }
    }

    /**
     * Affiche le formulaire de création d'une version
     */
    public function create()
    {
        // Vérifier si une version existe déjà
        if (Version::count() > 0) {
            return redirect()->route('admin.versions.index')
                ->with('error', 'Une version existe déjà. Vous pouvez uniquement la modifier.');
        }

        $data = $this->withBreadcrumb([
            'Versions' => route('admin.versions.index'),
            'Créer' => '#'
        ]);

        return view('back.versions.create', $data);
    }

    /**
     * Enregistre une nouvelle version
     */
    public function store(Request $request)
    {
        // Vérifier si une version existe déjà
        if (Version::count() > 0) {
            return redirect()->route('admin.versions.index')
                ->with('error', 'Une version existe déjà. Vous pouvez uniquement la modifier.');
        }

        $validated = $request->validate([
            'numero_appstore' => 'required|integer|min:1',
            'numero_playstore' => 'required|integer|min:1',
            'url_appstore' => 'required|url',
            'url_playstore' => 'required|url',
            'motif_appstore' => 'nullable|string',
            'motif_playstore' => 'nullable|string',
            'titre_appstore' => 'nullable|string',
            'titre_playstore' => 'nullable|string'
        ]);

        // Convertir les cases à cocher en booléens
        $validated['obligatoire_appstore'] = $request->has('obligatoire_appstore');
        $validated['obligatoire_playstore'] = $request->has('obligatoire_playstore');

        Version::create($validated);

        return redirect()->route('admin.versions.index')
            ->with('success', 'Version créée avec succès');
    }

    /**
     * Affiche le formulaire d'édition de la version
     */
    public function edit()
    {
        $version = Version::getActive();

        if (!$version) {
            return redirect()->route('admin.versions.create');
        }

        $data = $this->withBreadcrumb([
            'Versions' => route('admin.versions.index'),
            'Modifier' => '#'
        ], [
            'version' => $version
        ]);

        return view('back.versions.edit', $data);
    }

    /**
     * Met à jour la version
     */
    public function update(Request $request)
    {
        $version = Version::getActive();

        if (!$version) {
            return redirect()->route('admin.versions.create');
        }

        $validated = $request->validate([
            'numero_appstore' => 'required|integer|min:1',
            'numero_playstore' => 'required|integer|min:1',
            'url_appstore' => 'required|url',
            'url_playstore' => 'required|url',
            'motif_appstore' => 'nullable|string',
            'motif_playstore' => 'nullable|string',
            'titre_appstore' => 'nullable|string',
            'titre_playstore' => 'nullable|string',
            'obligatoire_appstore' => 'boolean',
            'obligatoire_playstore' => 'boolean',
        ]);

        // Convertir les cases à cocher en booléens
        $validated['obligatoire_appstore'] = $request->has('obligatoire_appstore');
        $validated['obligatoire_playstore'] = $request->has('obligatoire_playstore');

        $version->update($validated);

        return redirect()->route('admin.versions.index')
            ->with('success', 'Version mise à jour avec succès');
    }

    /**
     * Supprime la version (soft delete)
     */
    public function destroy()
    {
        $version = Version::getActive();

        if ($version) {
            $version->delete();
            return redirect()->route('admin.versions.create')
                ->with('success', 'Version supprimée avec succès');
        }

        return redirect()->route('admin.versions.index');
    }

    /**
     * API: Récupère la version actuelle pour les applications mobiles
     */
    public function getVersion(Request $request)
    {
        $version = Version::getActive();


        if (!$version) {
            return response()->json(['error' => 'Aucune version disponible'], 404);
        }

        return new VersionResource($version);
    }
}
