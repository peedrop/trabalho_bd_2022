<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turma extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['disciplina_id', 'professor_id', 'codigo'];

    protected $searchableFields = ['*'];

    protected $table = 'turma';

    public $timestamps = false;

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }
}
