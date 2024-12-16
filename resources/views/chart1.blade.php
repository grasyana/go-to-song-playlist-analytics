<div class=" mt-3 max-w-sm w-full bg-white rounded-lg shadow p-4 md:p-6">
    <div class="flex justify-between mb-3">
        <div class="flex justify-center items-center">
                        <h5 class="text-xl font-bold leading-none text-gray-900 pe-1">Languages</h5>
                        <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 hover:text-gray-900 cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
                        </svg>
                        </div>
                </div>

                <div class="py-6" id="donut-chart"></div>

                <div class="grid grid-cols-1 items-center border-gray-200 border-t justify-between">
                    <div class="flex justify-between items-center pt-5">
                    </div>
    </div>
 </div>

 <script>
    const languageNames = @json($languageNames);
    const songCounts = @json($songCounts);

    const getChartOptions = () => {
        return {
            series: songCounts,
            colors: ["#1C64F2", "#16BDCA", "#FDBA8C", "#E74694", "#FFAB00", "#8B5CF6", "#10B981"],
            chart: {
                height: 320,
                width: "100%",
                type: "donut",
            },
            stroke: {
                colors: ["transparent"],
                lineCap: "",
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontFamily: "Inter, sans-serif",
                                offsetY: 20,
                            },
                            total: {
                                showAlways: true,
                                show: true,
                                label: "Total Languages",
                                fontFamily: "Inter, sans-serif",
                                formatter: function (w) {
                                    const totalLanguages = w.globals.labels.length; 
                                    return `${totalLanguages}`; 
                                },
                            },
                            value: {
                                show: true,
                                fontFamily: "Inter, sans-serif",
                                offsetY: -20,
                                formatter: function (value) {
                                    return value + " songs"
                                },
                            },
                        },
                        size: "80%",
                    },
                },
            },
            grid: {
                padding: {
                    top: -2,
                },
            },
            labels: languageNames,
            dataLabels: {
                enabled: false,
            },
            legend: {
                position: "bottom",
                fontFamily: "Inter, sans-serif",
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function (value) {
                        return value
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            },
        };
    };

    if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
        chart.render();

        // Get all the checkboxes by their class name
        const checkboxes = document.querySelectorAll('#devices input[type="checkbox"]');

        // Function to handle the checkbox change event
        const handleCheckboxChange = (event, chart) => {
            const selectedLanguages = [];
            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    selectedLanguages.push(checkbox.value);
                }
            });
            // Filter song counts based on selected languages
            const filteredSongCounts = songCounts.filter((_, index) => selectedLanguages.includes(languageNames[index]));
            chart.updateSeries([{
                data: filteredSongCounts
            }]);
        };

        // Attach the event listener to each checkbox
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', (event) => handleCheckboxChange(event, chart));
        });

        // Handle filter form changes
        document.getElementById("filterForm").addEventListener("change", function () {
            updateCharts(this.value); // Passing the selected filter value
        });

        function updateCharts(filterValue) {
            fetchChartData(filterValue)
                .then(data => {
                    chart.updateSeries([{
                        data: data.songCounts // Update chart with filtered data
                    }]);
                });
        }
    }
</script>
