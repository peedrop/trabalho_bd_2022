<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'address'];

    protected $searchableFields = ['*'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
