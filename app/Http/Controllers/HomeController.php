<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profil;
use App\Models\Infoligne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $profils = Profil::paginate();

        $totalMessages = Infoligne::where('lire',0)->count();
        $infolignes = Infoligne::where('lire',0)->orderBy('created_at', 'desc')->get();

        $comptesuers = User::where('id',$user->id)->first();

        $profilsuersconets = Profil::where('user_id',$user->id)->first();
        return view('home', compact(
            'profils',
            'comptesuers',
                        'totalMessages',
                        'infolignes',
                        'profilsuersconets'));
    }
}
