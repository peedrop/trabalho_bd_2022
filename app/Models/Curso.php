<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['faculdade_id', 'nome'];

    protected $searchableFields = ['*'];

    protected $table = 'curso';

    public $timestamps = false;

    public function faculdade()
    {
        return $this->belongsTo(Faculdade::class);
    }

    public function disciplinas()
    {
        return $this->hasMany(Disciplina::class);
    }

    public function alunos()
    {
        return $this->belongsToMany(Aluno::class);
    }
}
