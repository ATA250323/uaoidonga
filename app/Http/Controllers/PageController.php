<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //

    public function contact()
    {


        return view('lespages.contact');
    }
    public function apropos()
    {

        return view('lespages.apropos');
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
        return view('lespages.accueil', compact('carousels', 'hasCarousel'));
    }
}
