<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if the table name follows Laravel's naming convention)
    protected $table = 'songs';

    // Define the fillable columns
    protected $fillable = [
        'title',
        'artist_id',
        'album_id',
        'genre',
        'release_date',
        'duration',
        'popularity',
        'stream',
        'language',
    ];

    // Relationship with Artist (A song belongs to an artist)
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    // Relationship with Album (A song belongs to an album)
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
