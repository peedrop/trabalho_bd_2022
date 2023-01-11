<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departamento extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nome', 'area'];

    protected $searchableFields = ['*'];

    protected $table = 'departamento';

    public $timestamps = false;

    public function disciplinas()
    {
        return $this->hasMany(Disciplina::class);
    }

    public function professors()
    {
        return $this->hasMany(Professor::class);
    }
}
