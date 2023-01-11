<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculdade extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nome', 'endereco'];

    protected $searchableFields = ['*'];

    protected $table = 'faculdade';

    public $timestamps = false;

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
