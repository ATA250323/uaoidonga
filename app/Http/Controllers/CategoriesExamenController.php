<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CategoriesExamen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriesExamenRequest;

class CategoriesExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $categoriesExamens = CategoriesExamen::paginate();

        return view('categories-examen.index', compact('categoriesExamens'))
            ->with('i', ($request->input('page', 1) - 1) * $categoriesExamens->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categoriesExamen = new CategoriesExamen();

         $examens = [
            ['examen' => __('traduction.examen1') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */],
            ['examen' => __('traduction.examen2') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */],
        ];
        return view('categories-examen.create', compact('categoriesExamen','examens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesExamenRequest $request): RedirectResponse
    {
        Auth::user();

    $request->validated();

    // Vérifier si le centre existe déjà (exemple par nom ou classe)
    if (CategoriesExamen::where('code', $request->code)->where('libelle', $request->libelle)->exists()) {
        return redirect()
            ->route('categories-examens.create')
            ->with('alertMessage', __('traduction.erreur_deja'));
    }

        CategoriesExamen::create($request->validated());

        return redirect()
        ->route('categories-examens.index')
        ->with('success', __('traduction.save_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $categoriesExamen = CategoriesExamen::find($id);

        return view('categories-examen.show', compact('categoriesExamen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        // $categoriesExamen = CategoriesExamen::find($id);
        $categoriesExamen = CategoriesExamen::where('public_id',$id)->firstOrFail();

         $examens = [
            ['examen' => __('traduction.examen1') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */],
            ['examen' => __('traduction.examen2') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */],
        ];
        return view('categories-examen.edit', compact('categoriesExamen','examens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriesExamenRequest $request, CategoriesExamen $categoriesExamen): RedirectResponse
    {
        $categoriesExamen->update($request->validated());

        return Redirect::route('categories-examens.index',)
            ->with('success',
             __('traduction.update_success') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */
       );
    }

    public function destroy($id): RedirectResponse
    {

        $categoriesexamen = CategoriesExamen::where('public_id',$id)->firstOrFail();

        // Supprimer en base
        $categoriesexamen->delete();
        return Redirect::route('categories-examens.index')
            ->with('success', __('traduction.delete_success'));
    }
}
