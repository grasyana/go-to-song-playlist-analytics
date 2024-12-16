<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if the table name follows Laravel's naming convention)
    protected $table = 'albums';

    // Define the fillable columns
    protected $fillable = [
        'title',
        'artist_id',
    ];

    // Relationship with Artist (An album belongs to an artist)
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    // One-to-many relationship with songs (An album has many songs)
    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
