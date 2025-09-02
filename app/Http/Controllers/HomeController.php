<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EscortRequest;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $totalRequests = EscortRequest::count();
        $pendingRequests = EscortRequest::where('statut', 'en_attente')->count();
        $inProgressRequests = EscortRequest::where('statut', 'en_cours')->count();
        $approvedRequests = EscortRequest::where('statut', 'approuve')->count();
        $completedRequests = EscortRequest::where('statut', 'termine')->count();
        $rejectedRequests = EscortRequest::where('statut', 'refuse')->count();

        // Statistiques du mois en cours
        $currentMonth = Carbon::now()->startOfMonth();
        $monthlyRequests = EscortRequest::where('created_at', '>=', $currentMonth)->count();
        $monthlyApproved = EscortRequest::where('created_at', '>=', $currentMonth)
            ->where('statut', 'approuve')->count();

        // Demandes urgentes
        $urgentRequests = EscortRequest::whereIn('urgence', ['urgent', 'tres_urgent'])
            ->whereIn('statut', ['en_attente', 'en_cours'])
            ->count();

        // Demandes récentes (7 derniers jours)
        $recentRequests = EscortRequest::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Prochaines missions (7 prochains jours)
        $upcomingMissions = EscortRequest::where('date_mission', '>=', Carbon::now())
            ->where('date_mission', '<=', Carbon::now()->addDays(7))
            ->where('statut', 'approuve')
            ->orderBy('date_mission', 'asc')
            ->limit(5)
            ->get();

        // Répartition par type d'escorte
        $requestsByType = EscortRequest::selectRaw('type_escorte, COUNT(*) as count')
            ->groupBy('type_escorte')
            ->get()
            ->pluck('count', 'type_escorte');

        // Répartition par urgence
        $requestsByUrgency = EscortRequest::selectRaw('urgence, COUNT(*) as count')
            ->groupBy('urgence')
            ->get()
            ->pluck('count', 'urgence');

        // Évolution des demandes (6 derniers mois)
        $monthlyEvolution = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyEvolution[] = [
                'month' => $month->format('M Y'),
                'count' => EscortRequest::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count()
            ];
        }

        return view('dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'inProgressRequests',
            'approvedRequests',
            'completedRequests',
            'rejectedRequests',
            'monthlyRequests',
            'monthlyApproved',
            'urgentRequests',
            'recentRequests',
            'upcomingMissions',
            'requestsByType',
            'requestsByUrgency',
            'monthlyEvolution'
        ));
    }
}
