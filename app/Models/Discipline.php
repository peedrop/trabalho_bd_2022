<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discipline extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['course_id', 'department_id', 'name', 'code'];

    protected $searchableFields = ['*'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
