<?php

namespace App\Http\Controllers;

use App\Models\Formateurs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class FormateursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formateurs = Formateurs::orderBy('id','DESC')->get();
        return view('formateurs.index',compact('formateurs'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password'
        ]);

        $formateur = new Formateurs();
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $role= Role::where('name','Formateurs')->first();
        $user->assignRole([$role->id]);

        $formateur->nom = $request->nom;
        $formateur->prenom = $request->prenom;
        $formateur->cin = $request->cin;
        $formateur->tel = $request->tel;
        $formateur->adresse = $request->adresse;
        $formateur->deplome = $request->deplome;
        $formateur->user_id = $user->id;
        $formateur->save();

        return redirect('/formateurs');
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
        $formateur = Formateurs::find($id);
        $formateur->nom = $request->nom;
        $formateur->prenom = $request->prenom;
        $formateur->cin = $request->cin;
        $formateur->tel = $request->tel;
        $formateur->adresse = $request->adresse;
        $formateur->deplome = $request->deplome;

        $formateur->update();
        return redirect('formateurs/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formations  $formations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formateur = Formateurs::find($id);
        User::find($formateur->user_id)->delete();
        return redirect('formateurs/');
    }
}
