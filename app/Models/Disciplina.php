<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disciplina extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['curso_id', 'departamento_id', 'nome', 'codigo'];

    protected $searchableFields = ['*'];

    protected $table = 'disciplina';

    public $timestamps = false;

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }
}
