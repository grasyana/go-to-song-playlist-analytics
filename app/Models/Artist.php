<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if the table name follows Laravel's naming convention)
    protected $table = 'artists';

    // Define the fillable columns (adjust these to your table's actual columns)
    protected $fillable = [
        'name',
    ];

    // One-to-many relationship with albums (An artist has many albums)
    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    // One-to-many relationship with songs (An artist has many songs)
    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
