<?php

namespace App\Http\Controllers;

use App\Models\Etudiants;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EtudiantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etudiants = Etudiants::orderBy('id','DESC')->get();
        return view('etudiants.index',compact('etudiants'));
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
        $etudiant = new Etudiants();
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $role= Role::where('name','Etudiants')->first();
        $user->assignRole([$role->id]);

        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->cin = $request->cin;
        $etudiant->tel = $request->tel;
        $etudiant->ddn = $request->ddn;
        $etudiant->user_id = $user->id;
        $etudiant->save();

        
        if(isset($request->page)){
            if ($request->page=="login") {
                return redirect('/login');
            }
        }

        return redirect('/etudiants');
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
        $etudiant = Etudiants::find($id);
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->cin = $request->cin;
        $etudiant->tel = $request->tel;
        $etudiant->ddn = $request->ddn;

        $etudiant->update();
        return redirect('etudiants/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formations  $formations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etudiant = Etudiants::find($id);
        User::find($etudiant->user_id)->delete();
        return redirect('etudiants/');
    }
}
