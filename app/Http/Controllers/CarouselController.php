<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CarouselRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request): View
{
    $user = Auth::user();

    $carousels = Carousel::all();
    $carouselCount = Carousel::count();

    // Nombre de carousels en trop par rapport à la limite 3
    $nombres = max(0, $carouselCount - 3);
    return view('carousel.index', compact(
        'carousels',
        'carouselCount',
        'nombres'
    ));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $carousel = new Carousel();

        return view('carousel.create', compact('carousel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(CarouselRequest $request): RedirectResponse
    // {
    //     Carousel::create($request->validated());

    //     return Redirect::route('carousels.index')
    //         ->with('success', 'Carousel created successfully.');
    // }

    public function store(CarouselRequest $request): RedirectResponse
    {
        // Carousel::create($request->validated());

        // return Redirect::route('carousels.index')
        //     ->with('success', 'Carousel created successfully.');
            Auth::user();

            $request->validated();

             if (Carousel::count() >= 3) {
                    return redirect()->back()
                        ->with('error', 'Limite de 3 carousels atteinte');
            }

            if ($request->hasFile('image')) {
                // Générer un nom unique
                $imageName = time() . '.' . $request->file('image')->extension();

                // Stocker la vidéo avec le Storage Laravel
                $imagePath = $request->file('image')->storeAs('carousel', $imageName, 'public');
                Carousel::create([
                    'image' =>  $imagePath,
                    ]);
                    // $ajoutcv_id = $request->ajoutcv_id;
                            return Redirect::route('carousels.index')
                    ->with('success', __('traduction.save_success'));
            }else
            {
                return Redirect::route('carousels.index')->with('error',  __('traduction.erreurphoto') /** resources/lang/fr/traduction.php ou resources/lang/ar/traduction.php */);
            }
    }
    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $carousel = Carousel::find($id);

        return view('carousel.show', compact('carousel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $carousel = Carousel::find($id);

        return view('carousel.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarouselRequest $request, $id): RedirectResponse
    {
        // $carousel->update($request->validated());

        // return Redirect::route('carousels.index')
        //     ->with('success', 'Carousel updated successfully');

        $request->validated();

            $carousel = Carousel::where('public_id',$id)->firstOrFail();
            if ($request->hasFile('image')) {

                // Supprimer le fichier physique
                Storage::disk('public')->delete($carousel->image);

                // Générer un nom unique
                $imageName = time() . '.' . $request->file('image')->extension();

                // Stocker la vidéo avec le Storage Laravel
                $imagePath = $request->file('image')->storeAs('carousel', $imageName, 'public');

                    $carousel->image = $imagePath;
                    $carousel->save();
                    return redirect()->route('carousels.index')->with('succes', __('traduction.update_success') );
                }else{
                            return Redirect::route('carousels.index')
                    ->with('error', __('traduction.erreurphoto') );
                }
    }

    public function destroy($id): RedirectResponse
    {
        // Carousel::find($id)->delete();
        $carousel = Carousel::where('public_id',$id)->firstOrFail();

        // Supprimer le fichier physique
        Storage::disk('public')->delete($carousel->image);

        // Supprimer en base
        $carousel->delete();
        return Redirect::route('carousels.index')
            ->with('success', __('traduction.delete_success'));
    }
}
