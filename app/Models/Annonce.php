<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Annonce extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'categorie',
        'ville',
        'titreAnnonce',
        'descriptionAnnonce',
        'prix',
        'photo',
        'user_id',
        'validate'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
