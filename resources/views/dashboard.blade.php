<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>Data Analytics</title>
</head>
<body>
    <section>
        @include('sidebar')
        <section class="mt-20 p-4 sm:ml-64">
        <div class="flex justify-between items-center">
            <!-- Breadcrumb for filter-->
            <div class="flex items-center w-1/2">
            <form method="GET" action="{{ route('dashboard') }}" id="filterForm">
                @csrf
                <nav class="flex justify-between" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center ml-8 mb-3 sm:mb-3">
                        <li>
                            <div class="flex items-center">
                                <button id="dropdownProject" data-dropdown-toggle="dropdown-project"
                                    class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-100">
                                    <svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 16 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm9-10v.4A3.6 3.6 0 0 1 8.4 9H6.61A3.6 3.6 0 0 0 3 12.605M14.458 3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                                    </svg>
                                    Genres
                                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <div id="dropdown-project" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefault">
                                        <li>
                                            <a href="{{ route('dashboard') }}"
                                                class="block px-4 py-2 hover:bg-gray-100">All</a>
                                        </li>
                                        @foreach ($genres as $genre)
                                            <li>
                                                <a href="{{ route('dashboard', ['genre' => $genre]) }}"
                                                    class="block px-4 py-2 hover:bg-gray-100">{{ $genre }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <span class="mx-2 text-gray-400">/</span>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <button id="dropdownDatabase" data-dropdown-toggle="dropdown-database"
                                    class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-100">
                                    <svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 16 20">
                                        <path d="M8 5.625c4.418 0 8-1.063 8-2.375S12.418.875 8 .875 0 1.938 0 3.25s3.582 2.375 8 2.375Zm0 13.5c4.963 0 8-1.538 8-2.375v-4.019c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353c-.193.081-.394.158-.6.231l-.189.067c-2.04.628-4.165.936-6.3.911a20.601 20.601 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244c-.053-.028-.113-.053-.165-.082v4.019C0 17.587 3.037 19.125 8 19.125Zm7.09-12.709c-.193.081-.394.158-.6.231l-.189.067a20.6 20.6 0 0 1-6.3.911 20.6 20.6 0 0 1-6.3-.911l-.189-.067a10.719 10.719 0 0 1-.852-.34 8.08 8.08 0 0 1-.493-.244C.112 6.035.052 6.01 0 5.981V10c0 .837 3.037 2.375 8 2.375s8-1.538 8-2.375V5.981c-.052.029-.112.054-.165.082a8.08 8.08 0 0 1-.745.353Z" />
                                    </svg>
                                    Year
                                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <div id="dropdown-database" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefault">
                                        <li>
                                            <a href="{{ route('dashboard') }}"
                                                class="block px-4 py-2 hover:bg-gray-100">All</a>
                                        </li>
                                        @foreach ($years as $year)
                                            <li>
                                                <a href="{{ route('dashboard', ['year' => $year]) }}"
                                                    class="block px-4 py-2 hover:bg-gray-100">{{ $year }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>

                    </ol>
                </nav>
            </form>
            </div>

            <div class="flex justify-end items-center w-full">
                <form class="inline-flex items-right mr-4 mb-3">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 15.5V5s3 1 3 4m-7-3H4m9 4H4m4 4H4m13 2.4c0 1.326-1.343 2.4-3 2.4s-3-1.075-3-2.4 1.343-2.4 3-2.4 3 1.075 3 2.4Z"/>
                            </svg>
                        </div>
                        <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5 " placeholder="Search song name..." required />
                    </div>
                    <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-green-700 rounded-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </form>
            </div>

            </div>
            <!-- Cards Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Card 1 -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-4 flex justify-between items-center">
                        <h5 class="text-lg font-semibold text-gray-800">
                            Total Songs:
                        </h5>
                        <span class="text-l text-green-700">{{$total_songs}}</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-4 flex justify-between items-center">
                        <h5 class="text-lg font-semibold text-gray-800">
                            Total Artists:
                        </h5>
                        <span class="text-l text-green-700">{{$total_artists}}</span>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-4 flex justify-between items-center">
                        <h5 class="text-lg font-semibold text-gray-800">
                            Total Albums:
                        </h5>
                        <span class="text-l text-green-700">{{$total_albums}}</span>
                    </div>
                </div>
            </div>


            <!-- Charts Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @include('chart1')
                @include('chart2')
                @include('chart3')
            </div>
            <div class="overflow-x-auto mt-8">
                @include('table')
            </div>
            </div>
        </section>
        
    </section>

    <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Toggle dropdown visibility on button click
                document.getElementById('dropdownProject').addEventListener('click', function () {
                    document.getElementById('dropdown-project').classList.toggle('hidden');
                });

                document.getElementById('dropdownDatabase').addEventListener('click', function () {
                    document.getElementById('dropdown-database').classList.toggle('hidden');
                });

                // Update dropdown button text on selection
                const updateDropdownText = (buttonId, selectedText) => {
                    const button = document.getElementById(buttonId);
                    button.innerHTML = `
                        ${selectedText}
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>`;
                };

                // Add event listeners for each genre and year option
                document.querySelectorAll('#dropdown-project a').forEach(item => {
                    item.addEventListener('click', function () {
                        updateDropdownText('dropdownProject', this.textContent);
                        document.getElementById('dropdown-project').classList.add('hidden');
                        // Optionally, submit the form if needed (uncomment next line)
                        // document.getElementById('filterForm').submit();
                    });
                });

                document.querySelectorAll('#dropdown-database a').forEach(item => {
                    item.addEventListener('click', function () {
                        updateDropdownText('dropdownDatabase', this.textContent);
                        document.getElementById('dropdown-database').classList.add('hidden');
                        // Optionally, submit the form if needed (uncomment next line)
                        // document.getElementById('filterForm').submit();
                    });
                });
            });

    </script>
</body>

</html>
