<?php

namespace App\Http\Controllers;

use App\Mail\ClientMail;
use App\Models\Facture;
use App\Models\Vente;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function envoyerEmailAuxClients(Request $request)
     {
         $client = Client::where('email',$request->email)->first();
     
             $messageContent = $request->message; 
             Mail::to($client->email)->send(new ClientMail($client, $messageContent));
     
         return redirect('/clients');
     }
    public function index()
    {
        $clients = Client::paginate(10);
        return view('clients.clients',['clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.addClient');
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
            'email'=>'required'
        ]);
        try {
            $client = new Client;
            $client->nom = $request->nom;
            $client->adresse = $request->adresse;
            $client->téléphone = $request->telephone;
            $client->email = $request->email;
            $client->save();
    
            
            
            return redirect('/clients');
            } catch (QueryException $e) {
            // Vérifiez si l'erreur est une duplication
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Le nom du client existe déjà.');
            }
            // Gérez d'autres exceptions si nécessaire
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout du client.');
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
        $client = Client::find($id);
        return view('clients.editClient',['client'=>$client]);
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
            'email'=>'required'
        ]);
        $client = Client::find($id);
        $client->nom = $request->nom;
        $client->adresse = $request->adresse;
        $client->téléphone = $request->telephone;
        $client->email = $request->email;
        $client->save();

        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);

        $factures = Facture::where('client_nom', $client->nom)->get();
        foreach ($factures as $facture) {
            $facture->delete();
        }
    
        $ventes = Vente::where('client_nom', $client->nom)->get();
        foreach ($ventes as $vente) {
            $vente->delete();
        }
    
        $client->delete();
    
        return redirect('/clients');
    }
}
