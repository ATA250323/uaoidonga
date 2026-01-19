<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Video;
use App\Models\Albumb;
use App\Models\Carousel;
use Illuminate\View\View;
use App\Models\Evennement;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\PhotoEvennement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PageacceuilController extends Controller
{
    //

    public function pageacceuil(Request $request,$public_id): View|RedirectResponse
    {
       //id connecter
      $user= Auth::user();

        $today = Carbon::now();

        $etablissement = Etablissement::where('public_id', $public_id)->first();

        $role = $user->roles->first();

        if (!$role) {
            $menus = collect();
        } else {
            $menus = $role->menus()->wherePivot('etablissement_id', $etablissement->id)->get();
        }

   if (Etablissement::where('public_id', $public_id)->whereHas('users.subscriptions', function ($query) {
                $query->where('status', 'active'); // abonnement actif
            })->exists())
    {
         $etablissement = Etablissement::where('public_id',$public_id)->first();

         $carousel = Carousel::where('etablissement_id',$etablissement->id)->first();
         $carousels = Carousel::where('etablissement_id',$etablissement->id)->get();

         $evennements = Evennement::where('etablissement_id',$etablissement->id)->get();

          // Récupérer uniquement les événements futurs
        $evennement_passers = Evennement::where('etablissement_id', $etablissement->id)
                ->whereDate('dates', '<=', Carbon::today()) // date <= aujourd'hui
                ->orderBy('dates', 'asc') // optionnel : trier du plus proche au plus loin
                ->get();
        $photoevennements = PhotoEvennement::where('etablissement_id',$etablissement->id)->get();

        // pour les photo des évennements
       $photosGroupees = PhotoEvennement::with('evennement')
        ->where('etablissement_id', $etablissement->id)
        ->get()
        ->groupBy('evennement_id');

         // pour les photo des Albumbs
       $albumbGroupees = Albumb::with('anneescolaire')
        ->where('etablissement_id', $etablissement->id)
        ->get()
        ->groupBy('anneescolaire_id');
        // les années des étalissements
         $anneescolaires = Anneescolaire::where('etablissement_id',$etablissement->id)->get();

        //  pour recupérer la vidéo d'un établissement
          $videos = Video::where('etablissement_id',$etablissement->id)->first();

        $nombreenregistrer = Carousel::where('etablissement_id',  $etablissement->id)->count();

        if ($nombreenregistrer > 0) {
                $nombres =  $nombreenregistrer - 3;
            } else {
                $nombres =  $nombreenregistrer;
             }

        return view('acceuil.index', compact('public_id',
                'carousel',
                            'carousels',
                            'nombres',
                            'nombreenregistrer',
                            'evennements',
                            'photoevennements',
                            'evennement_passers',
                            'photosGroupees','albumbGroupees','anneescolaires','videos','menus',));
      }else{
            return redirect::route('home',$public_id)->with('alertMessage',  __('traduction.no_etablissement') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */);
        }
    }
}
