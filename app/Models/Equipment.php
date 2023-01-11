<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'serial_number', 'room_id'];

    protected $searchableFields = ['*'];

    protected $table = 'equipments';

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
