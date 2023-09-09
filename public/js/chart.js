$(document).ready(function () {


    funccharts();
    function funccharts(){

    
    $.ajax({
        type: "GET",
        url: "/api/dashboard/sales-chart",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = $("#titleChart");
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Most Crypto Sales',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgb(255,0,0)',
                            'rgb(255,0,255)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1,
                        borderRadius: Number.MAX_VALUE,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                },
            });

        },
        error: function (error) {
            console.log(error);
        }
    });




    $.ajax({
        type: "GET",
        url: "/api/dashboard/class-chart",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = document.getElementById("salesChart");
            const chartAreaBorder = {
                id: 'chartAreaBorder',
                beforeDraw(chart, args, options) {
                    const {
                        ctx,
                        chartArea: {
                            left,
                            top,
                            width,
                            height
                        }
                    } = chart;
                    ctx.save();
                    ctx.strokeStyle = options.borderColor;
                    ctx.lineWidth = options.borderWidth;
                    ctx.setLineDash(options.borderDash || []);
                    ctx.lineDashOffset = options.borderDashOffset;
                    ctx.strokeRect(left, top, width, height);
                    ctx.restore();
                }
            };
            var myBarChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Top Class Bought',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgb(255,0,0)',
                            'rgb(255,0,255)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        chartAreaBorder: {
                            borderColor: 'blue',
                            borderWidth: 3,
                            borderDash: [0, 0],
                            borderDashOffset: 2,
                        }
                    }
                },
                plugins: [chartAreaBorder]
            });
        },
        error: function (error) {
            console.log(error);
        }
    });

    $.ajax({
        type: "GET",
        url: "/api/dashboard/top-chart",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = document.getElementById("topChart");
            const chartAreaBorder = {
                id: 'chartAreaBorder',
                beforeDraw(chart, args, options) {
                    const {
                        ctx,
                        chartArea: {
                            left,
                            top,
                            width,
                            height
                        }
                    } = chart;
                    ctx.save();
                    ctx.strokeStyle = options.borderColor;
                    ctx.lineWidth = options.borderWidth;
                    ctx.setLineDash(options.borderDash || []);
                    ctx.lineDashOffset = options.borderDashOffset;
                    ctx.strokeRect(left, top, width, height);
                    ctx.restore();
                }
            };
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Top Whalers',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgb(255,0,0)',
                            'rgb(255,0,255)',
                            'rgb(255,165,0)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        chartAreaBorder: {
                            borderColor: 'blue',
                            borderWidth: 3,
                            borderDash: [0, 0],
                            borderDashOffset: 2,
                        }
                    }
                },
                plugins: [chartAreaBorder]
            });
        },
        error: function (error) {
            console.log(error);
        }
    });


    $.ajax({
        type: "GET",
        url: "/api/dashboard/topchar-chart",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = document.getElementById("topcharChart");
            const chartAreaBorder = {
                id: 'chartAreaBorder',
                beforeDraw(chart, args, options) {
                    const {
                        ctx,
                        chartArea: {
                            left,
                            top,
                            width,
                            height
                        }
                    } = chart;
                    ctx.save();
                    ctx.strokeStyle = options.borderColor;
                    ctx.lineWidth = options.borderWidth;
                    ctx.setLineDash(options.borderDash || []);
                    ctx.lineDashOffset = options.borderDashOffset;
                    ctx.strokeRect(left, top, width, height);
                    ctx.restore();
                }
            };
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Crypto Monthly Sales',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgb(255,0,0)',
                            'rgb(255,0,255)',
                            'rgb(255,165,0)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        chartAreaBorder: {
                            borderColor: 'blue',
                            borderWidth: 3,
                            borderDash: [0, 0],
                            borderDashOffset: 2,
                        }
                    }
                },
                plugins: [chartAreaBorder]
            });
        },
        error: function (error) {
            console.log(error);
        }
    });



    $.ajax({
        type: "GET",
        url: "/api/dashboard/topnft-chart",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = document.getElementById("topnftChart");
            const chartAreaBorder = {
                id: 'chartAreaBorder',
                beforeDraw(chart, args, options) {
                    const {
                        ctx,
                        chartArea: {
                            left,
                            top,
                            width,
                            height
                        }
                    } = chart;
                    ctx.save();
                    ctx.strokeStyle = options.borderColor;
                    ctx.lineWidth = options.borderWidth;
                    ctx.setLineDash(options.borderDash || []);
                    ctx.lineDashOffset = options.borderDashOffset;
                    ctx.strokeRect(left, top, width, height);
                    ctx.restore();
                }
            };
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'NFT Monthly Sales',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgb(255,0,0)',
                            'rgb(255,0,255)',
                            'rgb(255,165,0)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        chartAreaBorder: {
                            borderColor: 'blue',
                            borderWidth: 3,
                            borderDash: [0, 0],
                            borderDashOffset: 2,
                        }
                    }
                },
                plugins: [chartAreaBorder]
            });
        },
        error: function (error) {
            console.log(error);
        }
    });



    $.ajax({
        type: "GET",
        url: "/api/dashboard/trade-chart",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var ctx = document.getElementById("tradeChart");
            const chartAreaBorder = {
                id: 'chartAreaBorder',
                beforeDraw(chart, args, options) {
                    const {
                        ctx,
                        chartArea: {
                            left,
                            top,
                            width,
                            height
                        }
                    } = chart;
                    ctx.save();
                    ctx.strokeStyle = options.borderColor;
                    ctx.lineWidth = options.borderWidth;
                    ctx.setLineDash(options.borderDash || []);
                    ctx.lineDashOffset = options.borderDashOffset;
                    ctx.strokeRect(left, top, width, height);
                    ctx.restore();
                }
            };
            var myBarChart = new Chart(ctx, {
                type: 'pie',
                data: {
                   
                    labels: data.labels,
                    datasets: [{
                        label: 'Available Trades on Market',
                        data: data.data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgb(255,0,0)',
                            'rgb(255,0,255)',
                            'rgb(255,165,0)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255,99,132,1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        chartAreaBorder: {
                            borderColor: 'blue',
                            borderWidth: 3,
                            borderDash: [0, 0],
                            borderDashOffset: 2,
                        }
                    }
                },
                plugins: [chartAreaBorder]
            });
        },
        error: function (error) {
            console.log(error);
        }
    });





    }
    

   
});
