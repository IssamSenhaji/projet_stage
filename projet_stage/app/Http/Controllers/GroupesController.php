<?php

namespace App\Http\Controllers;

use App\Models\Formations;
use App\Models\Groupes;
use Illuminate\Http\Request;

class GroupesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupes = Groupes::orderBy('id','DESC')->get();
        $formations = Formations::orderBy('id','DESC')->get();
        return view('groupes.index',compact('groupes','formations'));
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
        $groupe = new Groupes();

        $groupe->titre = $request->titre;
        $groupe->dated = $request->dated;
        $groupe->datef = $request->datef;
        $groupe->formation_id = $request->formation_id;
        $groupe->save();

        return redirect('/groupes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formations  $formations
     * @return \Illuminate\Http\Response
     */
    public function show(Formations $formations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formations  $formations
     * @return \Illuminate\Http\Response
     */
    public function edit(Formations $formations)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formations  $formations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $groupe = Groupes::find($id);
        $groupe->titre = $request->titre;
        $groupe->dated = $request->dated;
        $groupe->datef = $request->datef;
        $groupe->formation_id = $request->formation_id;

        $groupe->update();
        return redirect('groupes/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formations  $formations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Groupes::find($id)->delete();
        return redirect('groupes/');
    }
}
