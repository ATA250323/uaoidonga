<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoutefrController extends Controller
{
    //


    public function contact()
    {

        return view('fr.contact');
    }
    public function apropos()
    {

        return view('fr.apropos');
    }
    public function galleries()
    {

        return view('fr.galleries');
    }
    public function acceuil()
    {

        return view('fr.accueil');
    }
}
