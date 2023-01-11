<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Professor extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['departamento_id', 'name'];

    protected $searchableFields = ['*'];

    protected $table = 'professor';

    public $timestamps = false;

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }
}
