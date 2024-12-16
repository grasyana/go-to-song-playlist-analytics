<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Album;
use App\Models\Song;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function home(Request $request)
    {
        $totalGenres = Song::select('genre')->distinct()->count();
        // Initialize the base query for songs
        $query = Song::query();

        // Apply genre filter if selected and it's not 'All'
        if ($request->has('genre') && $request->genre && $request->genre !== 'All') {
            $query->where('genre', $request->genre);
        }

        // Apply year filter if selected and it's not 'All'
        if ($request->has('year') && $request->year && $request->year !== 'All') {
            $query->where('release_date', $request->year);
        }

        // Get total counts, filtered by genre and year
        $totalArtists = Artist::whereHas('songs', function($query) use ($request) {
            // Apply genre and year filters to artists' songs
            if ($request->has('genre') && $request->genre && $request->genre !== 'All') {
                $query->where('genre', $request->genre);
            }
            if ($request->has('year') && $request->year && $request->year !== 'All') {
                $query->where('release_date', $request->year);
            }
        })->count();

        $totalAlbums = Album::whereHas('songs', function($query) use ($request) {
            // Apply genre and year filters to albums' songs
            if ($request->has('genre') && $request->genre && $request->genre !== 'All') {
                $query->where('genre', $request->genre);
            }
            if ($request->has('year') && $request->year && $request->year !== 'All') {
                $query->where('release_date', $request->year);
            }
        })->count();

        $totalSongs = $query->count();

        // Filter data for genres and years
        $genres = Song::distinct()->pluck('genre');
        $years = Song::distinct()
            ->when($request->has('genre') && $request->genre && $request->genre !== 'All', function ($query) use ($request) {
                // Filter years by genre if genre is selected and not 'All'
                return $query->where('genre', $request->genre);
            })
            ->orderBy('release_date', 'desc')
            ->pluck('release_date');

        // Fetch filtered songs based on the applied filters
        $filteredSongs = $query->get();

        // Fetch data for Chart 3 (Top 10 Artists by Song Count)
        $artistsQuery = Artist::withCount('songs')
            ->orderByDesc('songs_count')
            ->take(10);

        // Apply filters to artists if needed
        if ($request->has('genre') && $request->genre && $request->genre !== 'All') {
            $artistsQuery->whereHas('songs', function($query) use ($request) {
                $query->where('genre', $request->genre);
            });
        }
        if ($request->has('year') && $request->year && $request->year !== 'All') {
            $artistsQuery->whereHas('songs', function($query) use ($request) {
                $query->where('release_date', $request->year);
            });
        }

        $artists = $artistsQuery->get();
        $artistNames = $artists->pluck('name')->toArray();
        $streams = $artists->pluck('songs_count')->toArray();

        // Fetch data for Chart 2 (Top 10 Songs by Popularity)
        $songsQuery = Song::orderByDesc('popularity');

        // Apply filters to songs if needed
        if ($request->has('genre') && $request->genre && $request->genre !== 'All') {
            $songsQuery->where('genre', $request->genre);
        }
        if ($request->has('year') && $request->year && $request->year !== 'All') {
            $songsQuery->where('release_date', $request->year);
        }

        $songs = $songsQuery->get();
        $groupedSongs = $songs->groupBy('popularity');
        $songNames = [];
        $songPopularity = [];

        foreach ($groupedSongs as $popularity => $group) {
            $songNames[] = $group->first()->title;
            $songPopularity[] = $popularity;
        }

        $songNames = array_slice($songNames, 0, 10);
        $songPopularity = array_slice($songPopularity, 0, 10);

        // Fetch data for Chart 1 (Top Languages by Song Count)
        $languageQuery = Song::select('language', DB::raw('COUNT(*) as song_count'))
            ->groupBy('language')
            ->orderByDesc('song_count');

        // Apply filters to language query if needed
        if ($request->has('genre') && $request->genre && $request->genre !== 'All') {
            $languageQuery->where('genre', $request->genre);
        }
        if ($request->has('year') && $request->year && $request->year !== 'All') {
            $languageQuery->where('release_date', $request->year);
        }

        $languageCounts = $languageQuery->get();
        $languageNames = $languageCounts->pluck('language')->toArray();
        $songCounts = $languageCounts->pluck('song_count')->toArray();

        // Pass the data to the Blade view
        return view('dashboard', [
            'total_artists' => $totalArtists,
            'total_albums' => $totalAlbums,
            'total_songs' => $totalSongs,
            'total_genres' => $totalGenres,
            'genres' => $genres,
            'years' => $years,
            'artistNames' => $artistNames,
            'streams' => $streams,
            'songNames' => $songNames,
            'songPopularity' => $songPopularity,
            'languageNames' => $languageNames,
            'songCounts' => $songCounts,
            'languageCounts' => $languageCounts,
            'filteredSongs' => $filteredSongs, // Pass filtered songs
        ]);
    }
}
