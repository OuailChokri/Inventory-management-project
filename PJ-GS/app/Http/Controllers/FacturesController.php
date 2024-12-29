<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\Vente;
use Illuminate\Http\Request;

class FacturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Facture::with('ventes')->get();
        $clients = Client::all();
        $ventes = Vente::all();
        return view('factures.factures',[
            'factures'=>$factures,
            'clients'=>$clients,
            'ventes'=>$ventes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $clients = Client::all();
        $ventes = Vente::all();
        return view('factures.addFacture',[
            'clients'=>$clients,
            'ventes'=>$ventes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomClient' => 'required',
            'idVentes' => 'required|array',
            'idVentes.*' => 'exists:ventes,id',
        ]);

        // Calculer le montant total des ventes sélectionnées
        $total = Vente::whereIn('id', $request->idVentes)->sum('prix');

        // Créer la nouvelle facture
        $facture = new Facture;
        $facture->client_nom = $request->nomClient;
        $facture->montant_total = $total;
        $facture->save();

        // Associer les ventes sélectionnées à la facture
        $facture->ventes()->attach($request->idVentes);

        return redirect('/factures');
    }
    public function getVentesByClient($client_nom)
    {
        $ventes = Vente::where('client_nom', $client_nom)->get();
        return response()->json(['ventes' => $ventes]);
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
        $facture = Facture::find($id);
        return view('factures.editFacture',['facture'=>$facture]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'total'=>'required',
        ]);
        $facture = Facture::find($id);

        $facture->montant_total = $request->total;
        $facture->save();
        
        return redirect('/factures');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $facture = Facture::findOrFail($id);
        $facture->delete();
        return redirect('/factures');
    }
}
