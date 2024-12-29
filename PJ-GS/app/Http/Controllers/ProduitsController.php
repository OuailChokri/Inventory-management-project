<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::paginate(10);
        $produitsEnStock = Achat::where('quantite','>',0)->get();

        return view('produits.produits',['produits'=>$produits,'produitsEnStock'=>$produitsEnStock]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produitsEnStock = Achat::where('quantite','>',0)->get();
        return view('produits.addProduit',['produitsEnStock'=>$produitsEnStock]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validation des champs du formulaire
    $request->validate([
        'nom' => 'required',
        'description' => 'required',
        'prix' => 'required',
        'categorie' => 'required',
        'dateEntre' => 'required',
        'dateFabrication' => 'required'
    ]);

    // Trouver la quantité totale achetée de ce produit
    $quantiteSurAchat = Achat::where('produit_nom', $request->nom)->sum('quantite');

    // Créer un nouveau produit
    $produit = new Produit;

    // Remplir les attributs du produit
    $produit->nom = $request->nom;
    $produit->description = $request->description;
    $produit->prix_unitaire = $request->prix;
    $produit->categorie = $request->categorie;
    $produit->quantite = $quantiteSurAchat; 
    $produit->dateEntree = $request->dateEntre;
    $produit->dateFabrication = $request->dateFabrication;

    // Enregistrer le produit
    $produit->save();

    $achat = Achat::where('produit_nom', $request->nom)->first();
    $achat->quantite = 0; 

    
    // Mettre à jour la quantité sur l'achat avec la quantité avant l'ajout
        $achat->quantiteAvantAjouter = $quantiteSurAchat; // Stocker la quantité initiale sur l'achat
        $achat->produit_nom = 
        $achat->save();
    
    // Rediriger vers la page des produits
    return redirect('/produits');
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
        $produit = Produit::find($id);
        return view('produits.editProduit',['produit'=>$produit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom'=>'required',
            'description'=>'required',
            'prix'=>'required',
            'categorie'=>'required',
            'quantite'=>'required',
            'dateEntre'=>'required',
            'dateFabrication'=>'required'
        ]);
        $produit = Produit::find($id);
        $produit->nom = $request->nom;
        $produit->description = $request->description;
        $produit->prix_unitaire = $request->prix;
        $produit->categorie = $request->categorie;
        $produit->quantite = $request->quantite;
        $produit->dateEntree = $request->dateEntre;
        $produit->dateFabrication = $request->dateFabrication;
        $produit->save();
        
        return redirect('/produits');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Produit::findOrFail($id);
        $client->delete();
        return redirect('/produits');
    }
}
