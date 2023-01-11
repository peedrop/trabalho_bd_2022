<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['university_id', 'name'];

    protected $searchableFields = ['*'];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
