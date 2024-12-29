<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function factures()
    {
        return $this->belongsToMany(Facture::class, 'facture_vente');
    }
    public function client()
    {
        return $this->belongsTo(Facture::class);
    }

}
