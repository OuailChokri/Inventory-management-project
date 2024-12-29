<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Mail\FournisseurMail;
use Illuminate\Support\Facades\Mail;

class FournisseursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

public function envoyerEmailAuxFournisseurs(Request $request)
{
    $fournisseur = Fournisseur::where('email',$request->email)->first(); // Supposons que Fournisseur est votre modèle de fournisseur

    $messageContent = $request->input('message');

    Mail::to($fournisseur->email)->send(new FournisseurMail($fournisseur, $messageContent));

    return redirect('/fournisseurs');
}
    public function index()
    {
        $fournisseurs = Fournisseur::paginate(10);
        return view('fournisseurs.fournisseurs',[
            'fournisseurs'=>$fournisseurs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.addFournisseur',[
            'fournisseurs'=>$fournisseurs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required',
            'adresse'=>'required',
            'telephone'=>'required',
            'email'=>'required',
        ]);
        try 
        {
            $fournisseur = new Fournisseur;
            $fournisseur->nom = $request->nom;
            $fournisseur->adresse = $request->adresse;
            $fournisseur->téléphone = $request->telephone;
            $fournisseur->email = $request->email;
            $fournisseur->save();
        
            return redirect('/fournisseurs');
        }
        catch (QueryException $e) {
            // Vérifiez si l'erreur est une duplication
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Le nom du Fournisseur existe déjà.');
            }
            // Gérez d'autres exceptions si nécessaire
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout du Fournisseur.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fournisseur = Fournisseur::find($id);
        return view('fournisseurs.editFournisseur',['fournisseur'=>$fournisseur]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom'=>'required',
            'adresse'=>'required',
            'telephone'=>'required',
            'email'=>'required',
        ]);
        
        $fournisseur = Fournisseur::find($id);
        $fournisseur->nom = $request->nom;
        $fournisseur->adresse = $request->adresse;
        $fournisseur->téléphone = $request->telephone;
        $fournisseur->email = $request->email;
        $fournisseur->save();
        
        return redirect('/fournisseurs');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();
        return redirect('/fournisseurs');
    }
}
