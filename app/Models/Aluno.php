<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aluno extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nome', 'email', 'data_nascimento', 'cpf'];

    protected $searchableFields = ['*'];

    protected $table = 'aluno';

    public $timestamps = false;

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function cursos()
    {
        return $this->belongsToMany(Curso::class);
    }
}
