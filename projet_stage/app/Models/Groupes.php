<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupes extends Model
{
    use HasFactory;

    public function Formations()
    {
        return $this->belongsTo(Formations::class, 'formation_id');
    }
}
