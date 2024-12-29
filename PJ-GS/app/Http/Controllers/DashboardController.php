<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achat;
use App\Models\Client;
use App\Models\Vente;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalClients = Client::count();
        $produitsEnStock = Produit::where('quantite','>',0)->count();
        $totalAchats = Achat::sum('prix');
        $totalVentes = Vente::sum('prix');
        $totalRevenue = $totalVentes - $totalAchats;
        $recentVentes = Vente::orderBy('id','desc')->take(5)->get();
        $recentClients = Client::orderBy('id','desc')->take(5)->get();
        $recentAchats = Achat::where('quantite','>',0)->orderBy('id','desc')->paginate(10);
        $countProduits = Produit::all()->count();
        
        return view('index',[
            'countProduits'=>$countProduits,
            'recentAchats'=>$recentAchats,
            'recentVentes' => $recentVentes,
            'recentClients' => $recentClients,
            'totalClients' => $totalClients,
            'totalAchats' => $totalAchats,
            'produitsEnStock' => $produitsEnStock,
            'totalRevenue' => $totalRevenue
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
