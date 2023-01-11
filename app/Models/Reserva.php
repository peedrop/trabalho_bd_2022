<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['data', 'sala_id'];

    protected $searchableFields = ['*'];

    protected $table = 'reserva';

    public $timestamps = false;

    protected $casts = [
        'data' => 'date',
    ];

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
