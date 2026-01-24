<?php

namespace App\Http\Controllers;

use App\Models\Apropo;
use App\Models\Temoin;
use App\Models\Carousel;
use App\Models\Dirigent;
use App\Models\Evennement;
use App\Models\Information;
use App\Models\Organisation;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //

    public function contact()
    {

        $carousel = Carousel::first();
        $apropos = Apropo::first();
        $organisation = Organisation::first();
        $lienorganisations = Organisation::all();

        return view('lespages.contact', compact('apropos','carousel','lienorganisations','organisation'));
    }
    public function apropos()
    {

        $carousel = Carousel::first();
        $carousels = Carousel::skip(1)->first();
        $organisation = Organisation::first();
        $lienorganisations = Organisation::all();
        return view('lespages.apropos', compact('carousel','carousels','lienorganisations','organisation'));
    }
    public function galleries()
    {

        return view('lespages.galleries');
    }
    public function acceuil()
    {
        // 1. Récupérer toutes les diapositives, triées par un ordre (si nécessaire)
        $carousels = Carousel::all();
        $hasCarousel = $carousels->isNotEmpty();
        $carousel = Carousel::first();
        $organisation = Organisation::first();
        $evennement = Evennement::first();
        $lienorganisations = Organisation::all();
        $organisations = Organisation::orderBy('created_at', 'desc')->take(4)->get();
        $evennements = Evennement::orderBy('created_at', 'desc')->take(6)->get();
        $dirigents = Dirigent::all();
        $dirigent = $dirigents->isNotEmpty();
        $temoins = Temoin::where('status', operator: 1)->paginate();
        $temoin = $temoins->isNotEmpty();
        return view('lespages.accueil', compact('carousels',
        'hasCarousel',
        'carousel',
        'organisation',
        'organisations',
        'evennement',
        'evennements',
        'dirigent',
        'dirigents',
        'temoins',
        'temoin',
        'lienorganisations'));
    }

     public function detaildomaine($id)
    {

    $organisation_id = Organisation::where('public_id',$id)->firstOrFail();

        $liste = collect(preg_split('/•|\n/', $organisation_id->description))
            ->filter()
            ->map(fn($item) => trim($item, " \t\n\r\0\x0B."));

        $organisation = Organisation::first();
        $lienorganisations = Organisation::all();
        $organisations = Organisation::orderBy('created_at', 'desc')->take(4)->get();

        return view('lespages.domaines', compact(
            'organisation',
            'organisations',
            'lienorganisations','organisation_id','liste'));
    }
}
