
              <div class=" mt-3 max-w-sm w-full bg-white rounded-lg shadow p-4 md:p-6">
                <div class="flex justify-between border-gray-200 border-b pb-3">
                    <div>
                    <span class="bg-red-100 text-red-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md">
                        Top 10 popular songs!
                    </span>
                    </div>
                </div>
                <div id="bar-chart1"></div>
                    <div class="grid grid-cols-1 items-center border-gray-200 border-t justify-between">
                    </div>
                </div>
<script>
           document.addEventListener('DOMContentLoaded',function(){

            const songNames = @json($songNames);
            const songPopularity = @json($songPopularity);

            const options = {

            series: [
                {
                name: "Top Songs",
                color: "#E74694",
                data: songPopularity,
                }

            ],
            chart: {
                sparkline: {
                enabled: false,
                },
                type: "bar",
                width: "100%",
                height: 350,
                toolbar: {
                show: false,
                }
            },
            fill: {
                opacity: 1,
            },
            plotOptions: {
                bar: {
                horizontal: true,
                columnWidth: "100%",
                borderRadiusApplication: "end",
                borderRadius: 6,
                dataLabels: {
                    position: "top",
                },
                },
            },
            legend: {
                show: true,
                position: "bottom",
            },
            dataLabels: {
                enabled: false,
            },
            tooltip: {
                shared: true,
                intersect: false,
                formatter: function (value) {
                return "" + value
                }
            },
            xaxis: {
                labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500'
                },
                formatter: function(value) {
                    return "" + value
                }
                },
                categories: songNames,
                axisTicks: {
                show: false,
                },
                axisBorder: {
                show: false,
                },
            },
            yaxis: {
                labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500'
                }
                }
            },
            grid: {
                show: true,
                strokeDashArray: 4,
                padding: {
                left: 2,
                right: 2,
                top: -20
                },
            },
            fill: {
                opacity: 1,
            }
            }

            if(document.getElementById("bar-chart1") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("bar-chart1"), options);
            chart.render();
            }
            })

            document.getElementById("filterForm").addEventListener("change", function() {
                updateCharts(this.value); // Passing the selected filter value
            });

            function updateCharts() {
                    fetchChartData('/getChartData2')
                        .then(data => {
                            chart2.updateSeries([{
                                data: data.songPopularity // Update chart2 with the filtered data
                            }]);
                        });
                }

                function fetchChartData() {
                return fetch(`/getChartData?filter=${getChartData2}`) // Send the filter value to the backend
                    .then(response => response.json());
                }
</script>