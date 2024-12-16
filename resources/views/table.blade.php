<h2 class="text-2xl font-semibold text-green-700 mb-4">Songs filtered by genre:</h2>

<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-4 py-3">Track</th>
            <th scope="col" class="px-4 py-3">Artist</th>
            <th scope="col" class="px-4 py-3">Stream</th>
            <th scope="col" class="px-4 py-3">Genre</th>
            <th scope="col" class="px-4 py-3">Release Year</th>
        </tr>
    </thead>
    <tbody>
        @foreach($filteredSongs->take(10) as $song) <!-- Display only the first 10 songs -->
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-4 py-3">{{ $song->title }}</td>
                <td class="px-4 py-3">{{ $song->artist->name }}</td>
                <td class="px-4 py-3">{{ $song->stream}}</td> <!-- Assuming `stream_count` is a property of Song -->
                <td class="px-4 py-3">{{ $song->genre }}</td>
                <td class="px-4 py-3">{{ $song->release_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
