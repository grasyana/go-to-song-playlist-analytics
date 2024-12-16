
            <div class=" mt-3 max-w-sm w-full bg-white rounded-lg shadow p-4 md:p-6">
                <div class="flex justify-between border-gray-200 border-b pb-3">
                    <div>
                    <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md">
                        Top artists by songs count!
                    </span>
                    </div>
                </div>
                <div id="bar-chart"></div>
                    <div class="grid grid-cols-1 items-center border-gray-200 border-t justify-between">
                    </div>
                </div>

    <script>


        const artistNames = @json($artistNames);
        const streams = @json($streams);

        const options = {

        series: [
            {
            name: "Top Artists",
            color: "#31C48D",
            data: streams,
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
            categories: artistNames,
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

        if(document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("bar-chart"), options);
        chart.render();
        }

        function updateCharts() {
                fetchChartData('/getChartData3')
                    .then(data => {
                        chart3.updateSeries([{
                            data: data.streams // Update chart3 with the filtered data
                        }]);
                    });
            }
</script>