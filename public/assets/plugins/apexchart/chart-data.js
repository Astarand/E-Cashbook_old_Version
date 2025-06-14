'use strict';
$(document).ready(function() {
    function generateData(baseval, count, yrange) {
        var i = 0;
        var series = [];
        while (i < count) {
            var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
            var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
            var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;
            series.push([x, y, z]);
            baseval += 86400000;
            i++;
        }
        return series;
    }
    
    // if ($('#sales_chart').length > 0) {
    //     var columnCtx = document.getElementById("sales_chart"),
    //         columnConfig = {
    //             colors: ['#22cc62', '#ff0000'],
    //             series: [{
    //                 name: "Received",
    //                 type: "column",
    //                 data: [100, 150, 80, 180, 150, 175, 201, 60, 200, 120, 190, 160,]
    //             }, {
    //                 name: "Expenses",
    //                 type: "column",
    //                 data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16,]
    //             }],
    //             chart: {
    //                 type: 'bar',
    //                 fontFamily: 'Poppins, sans-serif',
    //                 height: 365,
    //                 toolbar: {
    //                     show: false
    //                 }
    //             },
    //             plotOptions: {
    //                 bar: {
    //                     horizontal: false,
    //                     columnWidth: '60%',
    //                     endingShape: 'rounded'
    //                 },
    //             },
    //             dataLabels: {
    //                 enabled: false
    //             },
    //             stroke: {
    //                 show: true,
    //                 width: 2,
    //                 colors: ['transparent']
    //             },
    //             xaxis: {
    //                 categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct','Nov', 'Dec'],
    //             },
    //             yaxis: {
    //                 title: {
    //                     text: '₹ (thousands)'
    //                 }
    //             },
    //             fill: {
    //                 opacity: 1
    //             },
    //             tooltip: {
    //                 y: {
    //                     formatter: function(val) {
    //                         return "₹ " + val + " thousands"
    //                     }
    //                 }
    //             }
    //         };
    //     var columnChart = new ApexCharts(columnCtx, columnConfig);
    //     columnChart.render();
    // }

    

    
    
    
    

    

    
    
    
    


    
    
    if ($('#s-line-area').length > 0) {
        var sLineArea = {
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false,
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{
                name: 'series1',
                data: [31, 40, 28, 51, 42, 109, 100]
            }, {
                name: 'series2',
                data: [11, 32, 45, 32, 34, 52, 41]
            }],
            xaxis: {
                type: 'datetime',
                categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"],
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            }
        }
        var chart = new ApexCharts(document.querySelector("#s-line-area"), sLineArea);
        chart.render();
    }
    $(document).ready(function() {
        // Initial chart data
        var weeklyData = {
            categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            series: [{
                name: 'Subscriber',
                data: [44, 55, 57, 56, 61, 58, 63]
            }, {
                name: 'Trail User',
                data: [76, 85, 101, 98, 87, 105, 91]
            }]
        };

        var monthlyData = {
            categories: ['1st Week', '2nd Week', '3rd Week', '4th Week'],
            series: [{
                name: 'Subscriber',
                data: [200, 300, 400, 500]
            }, {
                name: 'Trail User',
                data: [150, 250, 350, 450]
            }]
        };

        var yearlyData = {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [{
                name: 'Subscriber',
                data: [1000, 1100, 1200, 1300, 1400, 1500, 1600, 1700, 1800, 1900, 2000, 2100]
            }, {
                name: 'Trail User',
                data: [800, 900, 1000, 1100, 1200, 1300, 1400, 1500, 1600, 1700, 1800, 1900]
            }]
        };

        // Initialize chart with weekly data
        var chart = new ApexCharts(document.querySelector("#s-col"), getChartOptions(weeklyData));
        chart.render();

        // Dropdown change event
        $('.dropdown-item').on('click', function() {
            var selectedOption = $(this).text().trim().toLowerCase();
            var newData;
            if (selectedOption === 'weekly') {
                newData = weeklyData;
            } else if (selectedOption === 'monthly') {
                newData = monthlyData;
            } else if (selectedOption === 'yearly') {
                newData = yearlyData;
            }
            chart.updateSeries(newData.series);
            chart.updateOptions({
                xaxis: {
                    categories: newData.categories
                }
            });
        });

        // Function to get chart options
        function getChartOptions(data) {
            return {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '45%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: data.series,
                xaxis: {
                    categories: data.categories
                },
                yaxis: {
                    title: {
                        text: '₹ (thousands)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Users"
                        }
                    }
                }
            };
        }
    });


    if ($('#s-col-stacked').length > 0) {
        var sColStacked = {
            chart: {
                height: 350,
                type: 'bar',
                stacked: true,
                toolbar: {
                    show: false,
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                },
            },
            series: [{
                name: 'PRODUCT A',
                data: [44, 55, 41, 67, 22, 43]
            }, {
                name: 'PRODUCT B',
                data: [13, 23, 20, 8, 13, 27]
            }, {
                name: 'PRODUCT C',
                data: [11, 17, 15, 15, 21, 14]
            }, {
                name: 'PRODUCT D',
                data: [21, 7, 25, 13, 22, 8]
            }],
            xaxis: {
                type: 'datetime',
                categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT', '01/05/2011 GMT', '01/06/2011 GMT'],
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            },
        }
        var chart = new ApexCharts(document.querySelector("#s-col-stacked"), sColStacked);
        chart.render();
    }
    
    if ($('#mixed-chart').length > 0) {
        var options = {
            chart: {
                height: 350,
                type: 'line',
                toolbar: {
                    show: false,
                }
            },
            series: [{
                name: 'Website Blog',
                type: 'column',
                data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
            }, {
                name: 'Social Media',
                type: 'line',
                data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
            }],
            stroke: {
                width: [0, 4]
            },
            title: {
                text: 'Traffic Sources'
            },
            labels: ['01 Jan 2001', '02 Jan 2001', '03 Jan 2001', '04 Jan 2001', '05 Jan 2001', '06 Jan 2001', '07 Jan 2001', '08 Jan 2001', '09 Jan 2001', '10 Jan 2001', '11 Jan 2001', '12 Jan 2001'],
            xaxis: {
                type: 'datetime'
            },
            yaxis: [{
                title: {
                    text: 'Website Blog',
                },
            }, {
                opposite: true,
                title: {
                    text: 'Social Media'
                }
            }]
        }
        var chart = new ApexCharts(document.querySelector("#mixed-chart"), options);
        chart.render();
    }
    if ($('#donut-chart').length > 0) {
        var donutChart = {
            chart: {
                height: 350,
                type: 'donut',
                toolbar: {
                    show: false,
                }
            },
            series: [44, 55, 41, 17],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }
        var donut = new ApexCharts(document.querySelector("#donut-chart"), donutChart);
        donut.render();
    }
     
});
