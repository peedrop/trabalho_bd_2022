<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'area'];

    protected $searchableFields = ['*'];

    public function disciplines()
    {
        return $this->hasMany(Discipline::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
