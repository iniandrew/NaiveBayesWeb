<?php

namespace App\Http\Controllers;

use App\Actions\NaiveBayesAction;
use App\Models\Registrant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegistrantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Registrant/Index', [
            'registrants' => Registrant::query()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function show(Registrant $registrant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function edit(Registrant $registrant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registrant $registrant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registrant $registrant)
    {
        //
    }

    /** impelement bayes algorithm */
    public function simulateBayes()
    {
        Return Inertia::render('Registrant/Simulate', [
            'cities' => Registrant::query()->distinct()->get('city'),
        ]);
    }

    public function simulateBayesAction(Request $request, NaiveBayesAction $action)
    {
        Return Inertia::render('Registrant/Simulate', [
            'cities' => Registrant::query()->distinct()->get('city'),
            'result' => $action->simulate($request),
        ]);
    }
}
