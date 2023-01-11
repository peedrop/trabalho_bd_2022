<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipamento extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nome', 'sala_id', 'num_serie'];

    protected $searchableFields = ['*'];

    protected $table = 'equipamento';

    public $timestamps = false;

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
