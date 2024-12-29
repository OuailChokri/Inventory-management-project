<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function ventes()
    {
        return $this->belongsToMany(Vente::class, 'facture_vente');
    }

}
