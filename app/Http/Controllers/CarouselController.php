<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CarouselRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $carousels = Carousel::paginate();

        return view('carousel.index', compact('carousels'))
            ->with('i', ($request->input('page', 1) - 1) * $carousels->perPage());
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
    public function store(CarouselRequest $request): RedirectResponse
    {
        Carousel::create($request->validated());

        return Redirect::route('carousels.index')
            ->with('success', 'Carousel created successfully.');
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
    public function update(CarouselRequest $request, Carousel $carousel): RedirectResponse
    {
        $carousel->update($request->validated());

        return Redirect::route('carousels.index')
            ->with('success', 'Carousel updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Carousel::find($id)->delete();

        return Redirect::route('carousels.index')
            ->with('success', 'Carousel deleted successfully');
    }
}
