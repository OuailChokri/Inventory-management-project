<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;

class VentesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventes = Vente::paginate(10);
        $clients = Client::all();
        $produits = Produit::where('quantite','>',0)->get();
        return view('ventes.ventes',[
            'ventes'=>$ventes,
            'clients'=>$clients,
            'produits'=>$produits
        ]);
    }
    public function getVentesByClient($client)
    {
        // Récupérer les ventes pour le client donné
        $ventes = Vente::where('client_nom', $client)->get();

        return response()->json(['ventes' => $ventes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $clients = Client::all();
        $produits = Produit::where('quantite','>',0)->get();
        return view('ventes.addVente',[
            'clients'=>$clients,
            'produits'=>$produits
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nomClient' => 'required',
        'nomProduit' => 'required',
        'quantite' => 'required|integer|min:1',
        'dateVente' => 'required|date',
    ]);

    // Rechercher le produit
    $produit = Produit::where('nom', $request->nomProduit)->first();

    if (!$produit) {
        return redirect()->back()->with('error', 'Le produit spécifié n\'existe pas.');
    }

    if ($produit->quantite < $request->quantite) {
        
        return redirect()->back()->with('error', 'La quantité demandée n\'est pas disponible.');
    }

    // Démarrer une transaction pour assurer l'atomicité
        $vente = new Vente;
        $vente->client_nom = $request->nomClient;
        $vente->produit_nom = $request->nomProduit;
        $vente->quantite = $request->quantite;
        $vente->prix = $produit->prix_unitaire * $request->quantite;
        $vente->date_vente = $request->dateVente;
        $vente->save();

        // Mettre à jour la quantité du produit
        $produit->quantite -= $request->quantite;
        if ($produit->quantite == 0) {
            $produit->status = 'Indisponible';
            $produit->save();
        }

    return redirect('/ventes')->with('success', 'La vente a été enregistrée avec succès.');
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
        $vente = Vente::find($id);
        return view('ventes.editVente',['vente'=>$vente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomClient'=>'required',
            'nomProduit'=>'required',
            'prix'=>'required',
            'quantite'=>'required',
            'dateVente'=>'required',
        ]);
        $vente = Vente::find($id);
        $vente->client_nom = $request->nomClient;
        $vente->produit_nom = $request->nomProduit;
        $vente->quantite = $request->quantite;
        $vente->prix = $request->prix;
        $vente->date_vente = $request->dateVente;
        $vente->save();
        
        return redirect('/ventes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vente = Vente::findOrFail($id);
        $vente->delete();
        return redirect('/ventes');
    }
}
