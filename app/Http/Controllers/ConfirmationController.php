<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\Demandecode;
use Illuminate\Support\Str;
 use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Facades\Mail;

class ConfirmationController extends Controller
{
    //

    public function confirmerCompte(Request $request)
    {
          request()->validate([
            'email' => ['required', 'string'],
            'codeconf' => ['required', 'string'],
            ]);
// dd($request->public_id);

            // Vérifie si un code établissement a été saisi
            if ($request->filled('public_id')) {
                $etab = Etablissement::where('public_id', $request->public_id)->first();

                if ($etab) {
                    $user = User::where('email', $request->email)
                            ->where('etablissement_id', $etab->id)
                            ->where('confirmation', $request->codeconf)->first();
                } else {
                    // Si l’établissement n’existe pas
                     return redirect('confirmation')->with('error', __('traduction.message_inscription.invalide'));
                }
            } else {
                // Si aucun établissement fourni → admin global seulement
             $user = User::where('email', $request->email)
                        ->where('confirmation', $request->codeconf)->first();
        }

        if (!$user) {
            return redirect('confirmation')->with('error', __('traduction.message_inscription.invalide'));
        }

        $user->update([
            'is_confirmed' => true,
        ]);

        return redirect('/login')->with('success',__('traduction.message_inscription.confirme_succes'));
    }


    public function demandecode()
    {
        $etablissements = Etablissement::all();
         return view('demandecode', compact('etablissements'));
    }


    public function envoiecode(Request $request)
    {
          request()->validate([
            'email' => ['required', 'string'],
            ]);

        // Vérifie si un code établissement a été saisi
            if ($request->filled('public_id')) {
                $etab = Etablissement::where('public_id', $request->public_id)->first();

                if ($etab) {
                    $user = User::where('email', $request->email)
                            ->where('etablissement_id', $etab->id)->first();
                } else {
                    // Si l’établissement n’existe pas
                     return redirect('confirmation')->with('error', __('traduction.message_inscription.invalide'));
                }
            } else {
                // Si aucun établissement fourni → admin global seulement
             $user = User::where('email', $request->email)->first();
        }

        if (!$user) {
            return Redirect('demandecode')->with('error', __('traduction.invalideemail'));
        }else{

            if (!$user->confirmation) {
               $codegenerer =  collect(range('A', 'Z'))
                    ->merge(range(0, 9))
                    ->shuffle()
                    ->take(8)
                    ->implode('');
            //    $codegenerer = Str::upper(Str::random(8));

               $user->update([
                    'confirmation' => $codegenerer,
                ]);
                $code = $codegenerer;
            }else{

                $code = $user->confirmation;
            }
        // dd($code);
                try {
                        Mail::to($user->email)->send(new Demandecode($user, $code));
                        // Message de confirmation pour la redirection
                        // session()->flash('success', __('traduction.Evoicode'));
                    return redirect()->route('confirmation')->with('success', __('traduction.Evoicode'));

                    } catch (Exception $e) {
                        return redirect()->route('confirmation')->with('error', __('traduction.ErreurEvoicode'));
                        // session()->flash('error', __('traduction.ErreurEvoicode'));
                    }
                }
        }
}
