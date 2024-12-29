<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achat;
use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Database\QueryException;

class AchatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achats = Achat::orderBy('date_achat','desc')->paginate(10);
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        return view('achats.achats',[
            'achats'=>$achats,
            'produits'=>$produits,
            'fournisseurs'=>$fournisseurs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();
        return view('achats.addAchat',[
            'produits'=>$produits,
            'fournisseurs'=>$fournisseurs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nomFournisseur'=>'required',
        'nomProduit'=>'required',
        'quantite'=>'required',
        'prix'=>'required',
        'dateAchat'=>'required',
    ]);

    $fournisseur = $request->nomFournisseur;

    try {
        $achat = new Achat;
        $achat->fournisseur_nom = $request->nomFournisseur;
        $achat->produit_nom = $request->nomProduit;
        $achat->quantite = $request->quantite;
        $achat->prix = $request->prix;
        $achat->date_achat = $request->dateAchat;
        $achat->save();

        if ($fournisseur){
            $fournisseurToUpdate = Fournisseur::where('nom',$fournisseur)->first();
            $fournisseurToUpdate->nbreProduitFournis += 1;
            $fournisseurToUpdate->save();
        }
    } catch (QueryException $e) {
        if ($e->errorInfo[1] == 1062) { // Code d'erreur pour la violation de contrainte d'unicité
            // Gérer l'erreur ici (par exemple, afficher un message d'erreur à l'utilisateur)
            return redirect()->back()->with('error', 'Le Nom de produit existe déjà.');
        } else {
            // Gérer d'autres types d'erreurs
            return redirect()->back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    return redirect('/achats')->with('success', 'Achat ajouté avec succès.');
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
        $achat = Achat::find($id);
        return view('achats.editAchat',['achat'=>$achat]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantite'=>'required',
            'prix'=>'required',
            'dateAchat'=>'required',
        ]);
        $achat = Achat::find($id);
        
        $achat->quantite = $request->quantite;
        $achat->prix = $request->prix;
        $achat->date_achat = $request->dateAchat;
        $achat->save();
        
        return redirect('/achats');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $achat = Achat::findOrFail($id);
        $achat->delete();
        return redirect('/achats');
    }
}
