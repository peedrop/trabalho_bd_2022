<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sala extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['numero'];

    protected $searchableFields = ['*'];

    protected $table = 'sala';

    public $timestamps = false;

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class);
    }
}
